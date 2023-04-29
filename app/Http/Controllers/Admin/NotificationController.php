<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\Fcm;
use App\Models\BannerNotification;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
	
	function fcmindex()
    {
        $fcm=Fcm::first();
        return view('admin.notification.fcm',compact('fcm'));
    }
	 function store(Request $request)
    {
        $request->validate([
            'server_key' => 'required',
        ], [
            'server_key.required' => 'Server key is required!',
        ]);
		  $fcm=Fcm::first();
        $fcm->server_key = $request->server_key;
        $fcm->save();

      
       return redirect()->back()->withSuccess('Server Key Updated successfully');
    }
	
    function index()
    {
        $users=User::get();
        return view('admin.notification.notification',compact('users'));
    }
	 
    public function send(Request $request)
    { 
           $validator = Validator::make($request->all(), 
                [
                'title' => 'required',
                'message' => 'required',
                ],
                [
                'title.required' => 'Enter notification title.',
                'message.required' => 'Enter notification Message.',
                ]
        );
         if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $date = date('d-m-Y');
         $user = $request->user;
          if($user == NULL){
             return redirect()->back()->withErrors('Please Select any User(s)');
        }
        $countuser = count($user);
       
        $date = date('d-m-Y');

        $notification_title = $request->title;
        $notification_text = $request->message;
        
        $date = date('d-m-Y');
          
        $created_at = Carbon::now();
        
        $getFcm = DB::table('fcms')
                    ->first();
                    
        $getFcmKey = $getFcm->server_key;
        
          if($countuser >= 600){
              $userin = DB::table('users')
             ->get();
          }
          else{
               $userin = DB::table('users')
                        ->WhereIn('id', $user)
                        ->get();
          }         
         $getFcm = DB::table('fcms')
                    ->first();
                    
        $getFcmKey = $getFcm->server_key;
        
        
        foreach($userin as $us){
        $get_device_id[] = $us;
        }
        $loop =  count(array_chunk($get_device_id,600));  // count array chunk 1000
        $arrayChunk = array_chunk($get_device_id,600);   // devide array in 1000 chunk
        $device_id = array();
        
    
        for($i=0; $i<$loop ;$i++)
        {
            foreach($arrayChunk[$i] as $all_device_id)
            {       
                   
                        $device_id[] =  $all_device_id->cm_firebase_token;
                             
                                        $insertNotification =new Notification();
                                        $insertNotification->user_id = $all_device_id->id;
                                        $insertNotification->title = $notification_title;
                                        $insertNotification->image = Helpers::upload('notification/', 'png', $request->file('image'));
                                        $insertNotification->message  =$notification_text;
				                        $insertNotification->created_at=now();
				                        $insertNotification->updated_at=now();
				                        $insertNotification->save();
                                      
    
            }
			
			$notify_image= url('/').'/storage/app/public/notification/'.$insertNotification->image;
	
            $url = 'https://fcm.googleapis.com/fcm/send';
            $body=$notification_text;
            $customData=$url;
            $json_data = 
                [
                    "registration_ids" => $device_id,
                    "notification" => [
                        "body" => $body,
                        "title" => $notification_title,
                        "image"=>$notify_image
                    ],
                    "data" => [
                        "extra" => $customData
                    ]
                ];
         $data = json_encode($json_data); 
       
        $server_key = $getFcmKey;
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
	       
            curl_close($ch);
            unset($device_id); // unset the array value 

        }
        return redirect()->back()->with('success','Notification Sent to user Successfully');

    }
	
	
	  function bannernotification()
    {
        $n=BannerNotification::first();
        return view('admin.notification.bannernotification',compact('n'));
    }
	 
    public function storebanner(Request $request)
    { 
           $validator = Validator::make($request->all(), 
                [
                'start_date' => 'required',
                'end_date' => 'required',
				'image'=>'required'
                ],
                [
                'title.required' => 'Enter notification title.',
                'message.required' => 'Enter notification Message.',
			     'image.required'=>'Select Image'
                ]
        );
         if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $n=BannerNotification::first();
		if($n){
		$banner=BannerNotification::find($n['id']);
		$banner->start_date=$request->start_date;
		$banner->end_date=$request->end_date;
		$banner->image= Helpers::upload('notification/', 'png', $request->file('image'));
		$banner->save();
		}else{
		$banner=new BannerNotification();
		$banner->start_date=$request->start_date;
		$banner->end_date=$request->end_date;
		$banner->image= Helpers::upload('notification/', 'png', $request->file('image'));
		$banner->save();
		}
		
        return redirect()->back()->with('success','Banner Notification Added Successfully');

    }
   
   

}
