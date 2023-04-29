<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class LicenseBoxController extends Controller
{
    private $product_id;
    private $api_url;
    private $api_key;
    private $api_language;
    private $current_version;
    private $verify_type;
    private $verification_period;
    private $current_path;
    private $root_path;
    private $license_file;

    public function __construct(){ 
        $this->product_id = '3CDFCEC6';
        $this->api_url = 'https://verify.codefuse.org/';
        $this->api_key = '93BA919DC77F9D832017';
        $this->api_language = 'english';
        $this->current_version = 'v1.0.0';
        $this->verify_type = 'envato';
        $this->verification_period = 30;
        $this->current_path = dirname(__FILE__);
        $this->root_path = realpath($this->current_path.'/..');
        $this->license_file = $this->current_path.'/.lic';
    }

   

    

    private function call_api($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }
        $this_server_name = getenv('SERVER_NAME')?:
            $_SERVER['SERVER_NAME']?:
            getenv('HTTP_HOST')?:
            $_SERVER['HTTP_HOST'];
        $this_http_or_https = ((
            (isset($_SERVER['HTTPS'])&&($_SERVER['HTTPS']=="on"))or
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])and
                $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        )?'https://':'http://');
        $this_url = $this_http_or_https.$this_server_name.$_SERVER['REQUEST_URI'];
        $this_ip = getenv('SERVER_ADDR')?:$_SERVER['SERVER_ADDR']?:	$this->get_ip_from_third_party()?:gethostbyname(gethostname());
        
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array('Content-Type: application/json',
                'LB-API-KEY: '.$this->api_key,
                'LB-URL: '.$this_url,
                'LB-IP: '.$this_ip,
                'LB-LANG: '.$this->api_language)
        );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($curl);

       

        if (!$result && !Config::get('lightbox.LB_API_DEBUG')) {
            $rs = array(
                'status' => false,
                'message' => Config::get('lightbox.LB_TEXT_CONNECTION_FAILED')
            );

            return json_encode($rs);
        }
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($http_status != 200) {
            if (Config::get('lightbox.LB_API_DEBUG')) {
                $temp_decode = json_decode($result, true);
                $rs = array(
                    'status' => false,
                    'message' => ((!empty($temp_decode['error']))?
                        $temp_decode['error']:
                        $temp_decode['message'])
                );

                return json_encode($rs);
            } else {
                $rs = array(
                    'status' => false,
                    'message' => Config::get('lightbox.LB_TEXT_INVALID_RESPONSE')
                );
                return json_encode($rs);
            }
        }
        curl_close($curl);
        return $result;
    }

    public function check_connection()
    {
        $data_array =  array();
        $get_data = $this->call_api(
            'POST',
            $this->api_url.'api/check_connection_ext',
            json_encode($data_array)
        );
        $response = json_decode($get_data, true);
        return $response;
    }

    public function activate_license($license, $client, $create_lic = true)
    {
        $data_array =  array(
            "product_id"  => $this->product_id,
            "license_code" => $license,
            "client_name" => $client,
            "verify_type" => $this->verify_type
        );
        $get_data = $this->call_api(
            'POST',
            $this->api_url.'api/activate_license',
            json_encode($data_array)
        );
        $response = json_decode($get_data, true);
        if (!empty($create_lic)) {
            if ($response['status']) {
                $licfile = trim($response['lic_response']);
            //file_put_contents($this->license_file, $licfile, LOCK_EX);
            } else {
                //@chmod($this->license_file, 0777);
                if (is_writeable($this->license_file)) {
                    //unlink($this->license_file);
                }
            }
        }
        return $response;
    }

    public function get_license($license)
    {
        $data_array =  array(
            "license_code" => $license,
        );

        $get_data = $this->call_api(
            'POST',
            $this->api_url.'api/get_license',
            json_encode($data_array)
        );
        $response = json_decode($get_data, true);
        if (!empty($create_lic)) {
            if ($response['status']) {
                $licfile = trim($response['lic_response']);
            //file_put_contents($this->license_file, $licfile, LOCK_EX);
            } else {
                //@chmod($this->license_file, 0777);
                if (is_writeable($this->license_file)) {
                    //unlink($this->license_file);
                }
            }
        }
        return $response;
    }

    private function get_ip_from_third_party()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://ipecho.net/plain");
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
   
    public function verify_license($time_based_check = false, $license = false, $client = false)
    {
        if (!empty($license)&&!empty($client)) {
            $data_array =  array(
                    "product_id"  => $this->product_id,
                    "license_file" => null,
                    "license_code" => $license,
                    "client_name" => $client
                );
        } else {
            if (is_file($this->license_file)) {
                $data_array =  array(
                        "product_id"  => $this->product_id,
                        "license_file" => file_get_contents($this->license_file),
                        "license_code" => null,
                        "client_name" => null
                    );
            } else {
                $data_array =  array();
            }
        }
        $res = array('status' => true, 'message' => Config::get('lightbox.LB_TEXT_VERIFIED_RESPONSE'));
        if ($time_based_check && $this->verification_period > 0) {
            ob_start();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $type = (int) $this->verification_period;
            $today = date('d-m-Y');
            if (empty($_SESSION["3a208f52a03cbd2"])) {
                $_SESSION["3a208f52a03cbd2"] = '00-00-0000';
            }
            if ($type == 1) {
                $type_text = '1 day';
            } elseif ($type == 3) {
                $type_text = '3 days';
            } elseif ($type == 7) {
                $type_text = '1 week';
            } elseif ($type == 30) {
                $type_text = '1 month';
            } elseif ($type == 90) {
                $type_text = '3 months';
            } elseif ($type == 365) {
                $type_text = '1 year';
            } else {
                $type_text = $type.' days';
            }
            if (strtotime($today) >= strtotime($_SESSION["3a208f52a03cbd2"])) {
                $get_data = $this->call_api(
                    'POST',
                    $this->api_url.'api/verify_license',
                    json_encode($data_array)
                );
                $res = json_decode($get_data, true);
                if ($res['status']==true) {
                    $tomo = date('d-m-Y', strtotime($today. ' + '.$type_text));
                    $_SESSION["3a208f52a03cbd2"] = $tomo;
                }
            }
            ob_end_clean();
        } else {
            $get_data = $this->call_api(
                'POST',
                $this->api_url.'api/verify_license',
                json_encode($data_array)
            );
            $res = json_decode($get_data, true);
        }
        return $res;
    }
        
    
}
