<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\WithdrawalReq;
use App\Models\Earning;
use App\Models\Complain;
use App\Models\Order;
use App\Models\Click;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use App\Models\BusinessSetting;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

class CustomerController extends Controller
{
	
    public function customer_list(Request $request)
    {
		DB::table('users')->update([
            'notify' => 1,
        ]);
        $key = [];
        if($request->search)
        {
            $key = explode(' ', $request['search']);
        }
        $customers = User::
        when(count($key) > 0, function($query)use($key){
            foreach ($key as $value) {
                $query->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%");
            };
        })
        ->orderBy('id','desc')->paginate(10);
        return view('admin.customer.list', compact('customers'));
    }
	
	 public function withdraw_requests(Request $request)
    {
        DB::table('withdrawal_reqs')->update([
            'notify' => 1,
        ]);
        $customers = WithdrawalReq::with('user')->orderBy('id','desc')->paginate(15);
        return view('admin.customer.withdrawreq', compact('customers'));
    }
	 public function approve_withdraw_requests(Request $request, $id)
    {
        
        $customers = WithdrawalReq::find($id);
		 $customers->approved=1;
		 $customers->save();
		 
		 $check=WithdrawalReq::where('id',$id)->first();
		 $earning=Earning::where('user_id',$check->user_id)->first();
		 $earnings=Earning::find($earning->id);
		$earnings->withdrawal=$earning->withdrawal+$check->amount;
		$earnings->sent_for_withdrawal=0;
		$earnings->save();
		 $customer=User::where('id',$check->user_id)->first();
		if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => 'Withdraw Request Approved',
                        'description' => $check->amount.' has been marked Successfully transferred to your selected withdrawal medium('.$check->medium.').',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
        return redirect()->back()->withSuccess('withdraw request approved successfully');
    }
	
	 public function reject_withdraw_requests(Request $request, $id)
    {
        
        $customers = WithdrawalReq::find($id);
		 $customers->approved=2;
		 $customers->save();
		 
		 $check=WithdrawalReq::where('id',$id)->first();
		 $earning=Earning::where('user_id',$check->user_id)->first();
		 $earnings=Earning::find($earning->id);
		$earnings->rem_earning=$earning->rem_earning+$check->amount;
		$earnings->sent_for_withdrawal=0;
		$earnings->save();
		 $customer=User::where('id',$check->user_id)->first();
		if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => 'Withdraw Request Rejected',
                        'description' => 'Withdrawal Request Of amount '.$check->amount.' has been marked Rejected.',
                        'order_id' => '',
                        'image' => ''
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                }
        return redirect()->back()->withSuccess('withdraw request rejected successfully');
    }
	
    public function index()
    {
        return view('admin-views.customer.index');
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:users',
        ], [
            'name.required' => 'name is required'
        ]);

        if ($request->has('image')) {
            $image_name = Helpers::upload('user/', 'png', $request->file('image'));
        } else {
            $image_name = NULL;
        }

        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = $image_name;
        $user->is_phone_verified = 1;
        $user->status = 1;
        $user->password = $request->password;
        $user->reg_completed = "completed";
        $user->save();
        
         return redirect()->route('admin.customer.list')->withSuccess(trans('messages.customer_added_successfully'));
 
    }
    
     
    public function status(User $customer, Request $request)
    {
       
        $customer->status = $request->status;
        $customer->save();

        try
        {
            if($request->status == 0)
            {   
                if(isset($customer->cm_firebase_token))
                {
                    $data = [
                        'title' => 'suspended',
                        'description' => 'your_account_has_been_blocked',
                        'order_id' => '',
                        'image' => '',
                        'type'=> 'block'
                    ];
                    Helpers::send_push_notif_to_device($customer->cm_firebase_token, $data);

                    DB::table('user_notifications')->insert([
                        'data'=> json_encode($data),
                        'user_id'=>$customer->id,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
                }

            }

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors('push notification failed '.$e);
        }
       return redirect()->back()->withSuccess('status updated');
       
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $customers=User::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('f_name', 'like', "%{$value}%")
                    ->orWhere('l_name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%");
            }
        })->orderBy('order_count','desc')->limit(50)->get();
        return response()->json([
            'view'=>view('admin-views.customer.partials._table',compact('customers'))->render()
        ]);
    }
	
	public function update_img(Request $request, $id)
    {
          DB::table('users')->where(['id' => $id])->update([
            'image' => Helpers::upload('user/', 'png', $request->file('image')),
			 'email'=>$request->email,
            'updated_at' => now(),
        ]);
       
        
		return redirect()->back()->withSuccess('User Image/Email Updated Successfully');
       
    }
	
	
	 public function complains(Request $request)
    {
        DB::table('complains')->update([
            'notify' => 1,
        ]);
        $customers = Complain::with('user')->orderBy('id','desc')->paginate(15);
        return view('admin.customer.complain', compact('customers'));
    }
	
	 public function orders(Request $request)
    {
        DB::table('orders')->update([
            'notify' => 1,
        ]);
        $customers = Order::with('user')->orderBy('id','desc')->paginate(15);
        return view('admin.customer.orders', compact('customers'));
    }

	
	
	 public function reply(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			 'reply'=>'required',
		 ], [
			'reply.required'=>'Enter Reply',
		 ]);
		
	   if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $customers = Complain::find($id);
		 $customers->reply=$request->reply;
		 $customers->status=1;
		 $customers->save();
       return redirect()->back()->withSuccess('Complain solved');
    }

   public function clicks(Request $request)
    {
        
        $customers = Click::with('user')->orderBy('id','desc')->paginate(15);
        return view('admin.customer.clicks', compact('customers'));
    }
	
	 public function deleteclicks(Request $request)
    {
		 $user_id=$request->user_id;
		 
		 $clicks= Click::where('created_at', '<=', Carbon::now()->subDays(10)->toDateTimeString())
			 ->delete();
		
        if($clicks){
        return redirect()->back()->withSuccess('successfully deleted clicks older then 10 days');
		}else{
			 return redirect()->back()->withError('nothing to delete');
		}
    }
	
	 public function user_profile(Request $request, $id)
    {
  
        
        $customers = User::where('id',$id)->first();
		 $clicks = Click::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(10,['*'], 'clicks');
		 $orders = Order::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(10,['*'], 'orders');
		  $reqs = WithdrawalReq::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(6,['*'], 'reqs');
		 $bankdetails=BankDetail::with('user')->where('user_id',$id)->first();
		 $complains=Complain::with('user')->where('user_id',$id)->orderBy('id','desc')->paginate(10,['*'], 'complains');
      
        return view('admin.customer.profile', compact('customers','clicks','orders','reqs','bankdetails','complains'));
    }
	
	
	public function searchuser(Request $request){
        $key = explode(' ', $request['search']);
        $customers=User::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%");
            }
        })->orderBy('name')->limit(50)->get();
		 
        return response()->json([
            'view'=>view('admin.customer.partials._table',compact('customers'))->render()
        ]);
    }
	
	  public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.customer.edit', compact('user'));
    }
	
	 public function update(Request $request,$id)
    {
		
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
        ], [
            'name.required' => 'name is required',
			'email.required'=>'email is required',
			'phone.required'=>'phone is required'
        ]);
		 
         if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
		  $user1 = User::find($request->id);
        if ($request->has('image')) {
            $image_name = Helpers::upload('user/', 'png', $request->file('image'));
        } else {
            $image_name = $user1->image;
        }
       
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image =  $image_name;
        $user->status = 1;
        $user->password = "12345";
        $user->save();
        
         return redirect()->route('admin.customer.list')->withSuccess(trans('messages.customer_added_successfully'));
 
    }

     public function exportcustomer(Request $request){
        $customers = User::get();
        $storage = [];
        if(count($customers)>0){
         foreach($customers as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'name'=>$item->name,
                'phone'=>$item->phone,
                'email'=>$item->email,
                'image'=>$item->image,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('customers.xlsx');
    }else{
        return redirect()->back()->withErrors('No Customer found');
    }
    }

    public function exportorders(Request $request){
        $order= Order::get();
        $storage = [];
        if(count($order)>0){
         foreach($order as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'advertiser'=>$item->advertisers,
                'image'=>$item->logo,
                'partner_order_id'=>$item->partner_order_id,
                'user_id'=>$item->user_id,
                'order_amount'=>$item->order_amount,
                'admin_earn'=>$item->admin_earn,
                'user_earning'=>$item->earning_amount,
                'order_status'=>$item->order_status,
                'affiliate_partner'=>$item->affiliate_partner,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('orders.xlsx');
    }else{
        return redirect()->back()->withErrors('No Order found');
    }
    }


    public function exportwithdrawal(Request $request){
        $wr= WithdrawalReq::get();
        $storage = [];
        if(count($wr)>0){
         foreach($wr as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'amount'=>$item->amount,
                'status'=>$item->approved,
                'user_id'=>$item->user_id,
                'medium'=>$item->medium,
                'medium_details'=>$item->medium_details,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('withdrawalreqs.xlsx');
    }else{
        return redirect()->back()->withErrors('No Withdrawal Requests found');
    }
    }
	
   public function exportclick(Request $request){
        $cl= Click::get();
        $storage = [];
        if(count($cl)>0){
         foreach($cl as $item)
        {
           
            $storage[] = [
                'id'=>$item->id,
                'advertiser'=>$item->name,
                'image'=>$item->image,
                'user_id'=>$item->user_id,
                'tracking_link'=>$item->tracking_link,
                'created_at'=>date('F jS, Y', strtotime($item->created_at)),
            ];
        }
        return (new FastExcel($storage))->download('clicks.xlsx');
    }else{
        return redirect()->back()->withErrors('No Clicks found');
    }
    }
}
