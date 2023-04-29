<?php

namespace App\Traits;
use DB;
use Mail;
use App\Users;
use App\Models\Notification;
use Carbon\Carbon;

trait SendInapp {

    
     public function sendnotification($user,$userin,$notification_title,$notification_text,$notify_image) {
         
         
            
            $userin = DB::table('users')->select('device_id','name','id')
                        ->WhereIn('id', $user)
                        ->get();
                        
         $getFcm = DB::table('fcm')
                    ->where('id', '1')
                    ->first();
                    
        $getFcmKey = $getFcm->server_key;
        $dater=Carbon::now();
        

        //you can insert post data into db for record here
        
        foreach($userin as $us){
        $get_device_id[] = $us;
        }
        $loop =  count(array_chunk($get_device_id,400));  // count array chunk 1000
        $arrayChunk = array_chunk($get_device_id,400);   // devide array in 1000 chunk
        $device_id = array();
        for($i=0; $i<$loop;$i++)
        {
            foreach($arrayChunk[$i] as $all_device_id)
            {       
                   
                        $device_id[] =  $all_device_id->device_id;
                        
                                    $insertNotification = DB::table('user_notification')
                                    ->insert([
                                        'user_id'=>$all_device_id->id,
                                        'noti_title'=>$notification_title,
                                         'image'=>$notification_text,
                                        'noti_message'=>$notify_image,
										'created_at'=> $dater
                                      
                                    ]);
            }
             $url = 'https://fcm.googleapis.com/fcm/send';
            $body=$notification_text;
            $customData=$url;
            $json_data = 
                [
                    "registration_ids" => $device_id,
                    "notification" => [
                        "body" => $body,
                        "title" => $notification_title,
                    ],
                    "data" => [
                        "extra" => $customData
                    ]
                ];
         $data = json_encode($json_data); 
       
        //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = $getFcmKey;
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        // CURL request to route notification to FCM connection server (provided by Google)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Oops! FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            unset($device_id); // unset the array value 

        }
        
                        
     }
    
             
}