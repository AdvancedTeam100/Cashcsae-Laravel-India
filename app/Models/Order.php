<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Fickrr\Models\Settings;
use Auth;
use Storage;
use Session;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Order extends Model
{
    use HasFactory;
	
	public function complain()
    {
        return $this->hasMany(Complain::class,'order_id');
    }
	
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
	
	public static function orderdataCheckdays($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->where('order_status','=',1)->join('users','users.id','orders.user_id')->get(); 
	$value = $get->count();
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->join('users','users.id','orders.user_id')->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->get(); 
	$value = $get->count();
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->join('users','users.id','orders.user_id')->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->get(); 
	$value = $get->count();

   }else{
      $get=DB::table('orders')->where('order_status','=',1)->join('users','users.id','orders.user_id')->whereBetween('locking_date',[$seventh_day, $today])->get(); 
	    $value = $get->count();
   }
 }else{
 	$get=DB::table('orders')->where('order_status','=',1)->join('users','users.id','orders.user_id')->whereBetween('locking_date',[$thirty, $today])->get(); 
	    $value = $get->count();
 }



    return $value;
	 
  }	
	
	 public static function adminrevenuedataCheckdays($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->where('order_status','=',1)->sum(\DB::raw('admin_earn'));
		$get2=DB::table('orders')->where('order_status','=',0)->sum(\DB::raw('admin_earn'));
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->sum(\DB::raw('admin_earn'));
		$get2=DB::table('orders')->where('order_status','=',0)->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->sum(\DB::raw('admin_earn'));
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->sum(\DB::raw('admin_earn'));
		 $get2=DB::table('orders')->where('order_status','=',0)->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->sum(\DB::raw('admin_earn'));

   }else{
      $get=DB::table('orders')->where('order_status','=',1)->whereBetween('locking_date',[$seventh_day, $today])->sum(\DB::raw('admin_earn'));
		$get2=DB::table('orders')->where('order_status','=',0)->whereBetween('locking_date',[$seventh_day, $today])->sum(\DB::raw('admin_earn'));
   }
 }else{
 	$get=DB::table('orders')->where('order_status','=',1)->whereBetween('locking_date',[$thirty, $today])->sum(\DB::raw('admin_earn'));
	$get2=DB::table('orders')->where('order_status','=',0)->whereBetween('locking_date',[$thirty, $today])->sum(\DB::raw('admin_earn'));
	
 }

      $checkd=array('sum1'=>$get,'sum2'=>$get2);
    return $checkd;
	 
  }	
	
	
	  public static function adminrevenuedataGraph($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('order_status','=',1)->get(); 
		 $get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('order_status','=',1)->get(); 


	$value = $get->count();
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->get(); 
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->get(); 
	$value = $get->count();
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->get();
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->get();
	$value = $get->count();

   }else{
      $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$seventh_day, $today])->get(); 
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$seventh_day, $today])->get(); 
	    $value = $get->count();
   }
 }else{
 	$get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$thirty, $today])->get(); 
	$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$thirty, $today])->get(); 
	    $value = $get->count();
 }
$days1=[];
$value1=[];
$value2=[];
foreach($get as $g){
	$check=DB::table('orders')->where('order_status','=',1)->where('locking_date',$g->locking_date)->sum(\DB::raw('admin_earn'));

	$days1[]=date('d F Y', strtotime($g->locking_date));
	
	$value1[]=round($check,0);
	
}
		  
		  foreach($get2 as $g2){
	$check2=DB::table('orders')->where('order_status','=',0)->where('locking_date',$g2->locking_date)->sum(\DB::raw('admin_earn'));
    $days1[]=date('d F Y', strtotime($g2->locking_date));
	$value2[]=round($check2,0);
	
}
$checkd=array('value'=>$value1,'value2'=>$value2,'date'=>$days1);
 
    return $checkd;
}
	
	
	 public static function userevenuedataCheckdays($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->where('order_status','=',1)->sum(\DB::raw('earning_amount'));
    $get2=DB::table('orders')->where('order_status','=',0)->sum(\DB::raw('earning_amount'));
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->sum(\DB::raw('earning_amount'));
		 $get2=DB::table('orders')->where('order_status','=',0)->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->sum(\DB::raw('earning_amount'));
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->sum(\DB::raw('earning_amount'));
		$get2=DB::table('orders')->where('order_status','=',0)->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->sum(\DB::raw('earning_amount'));

   }else{
      $get=DB::table('orders')->where('order_status','=',1)->whereBetween('locking_date',[$seventh_day, $today])->sum(\DB::raw('earning_amount'));
		 $get2=DB::table('orders')->where('order_status','=',0)->whereBetween('locking_date',[$seventh_day, $today])->sum(\DB::raw('earning_amount'));
   }
 }else{
 	$get=DB::table('orders')->where('order_status','=',1)->whereBetween('locking_date',[$thirty, $today])->sum(\DB::raw('earning_amount'));
	$get2=DB::table('orders')->where('order_status','=',0)->whereBetween('locking_date',[$thirty, $today])->sum(\DB::raw('earning_amount'));
	
 }

     $checkd=array('sum1'=>$get,'sum2'=>$get2);
    return $checkd;
	 
  }	
	
	
		
	  public static function userrevenuedataGraph($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('order_status','=',1)->get(); 
		 $get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('order_status','=',0)->get(); 

	$value = $get->count();
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->get(); 
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$thirty)->where('locking_date','<=',$today)->get(); 
	$value = $get->count();
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->get(); 
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->where('locking_date','>=',$ninety)->where('locking_date','<=',$today)->get(); 
		
	$value = $get->count();

   }else{
      $get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$seventh_day, $today])->get(); 
		$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$seventh_day, $today])->get(); 
	    $value = $get->count();
   }
 }else{
 	$get=DB::table('orders')->where('order_status','=',1)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$thirty, $today])->get(); 
	$get2=DB::table('orders')->where('order_status','=',0)->select('locking_date')->groupBy('locking_date')->whereBetween('locking_date',[$thirty, $today])->get(); 
	    $value = $get->count();
 }
$days1=[];
$value1=[];
$value2=[];
foreach($get as $g){
	$check=DB::table('orders')->where('order_status','=',1)->where('locking_date',$g->locking_date)->sum(\DB::raw('earning_amount'));

	$days1[]=date('d F Y', strtotime($g->locking_date));
	$value1[]=round($check,0);
	
}
		  foreach($get2 as $g2){
	$check2=DB::table('orders')->where('order_status','=',0)->where('locking_date',$g2->locking_date)->sum(\DB::raw('earning_amount'));
   $days1[]=date('d F Y', strtotime($g2->locking_date));
	$value2[]=round($check2,0);
	
}

    $checkd=array('value'=>$value1,'value2'=>$value2,'date'=>$days1);
    return $checkd;
}
	
	
	  public static function orderdataGraph($check_date)
  {
    
    $today = date('Y-m-d');
	
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('orders')->select('orders.locking_date')->join('users','users.id','orders.user_id')->groupBy('orders.locking_date')->where('orders.order_status','=',1)->get(); 

	$value = $get->count();
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('orders')->select('orders.locking_date')->join('users','users.id','orders.user_id')->groupBy('orders.locking_date')->where('orders.order_status','=',1)->where('orders.locking_date','>=',$thirty)->where('orders.locking_date','<=',$today)->get(); 
	$value = $get->count();
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('orders')->select('orders.locking_date')->join('users','users.id','orders.user_id')->groupBy('orders.locking_date')->where('orders.order_status','=',1)->where('orders.locking_date','>=',$ninety)->where('orders.locking_date','<=',$today)->get(); 
	$value = $get->count();

   }else{
      $get=DB::table('orders')->select('orders.locking_date')->join('users','users.id','orders.user_id')->groupBy('orders.locking_date')->where('orders.order_status','=',1)->whereBetween('orders.locking_date',[$seventh_day, $today])->get(); 
	    $value = $get->count();
   }
 }else{
 	$get=DB::table('orders')->select('orders.locking_date')->join('users','users.id','orders.user_id')->groupBy('orders.locking_date')->where('orders.order_status','=',1)->whereBetween('orders.locking_date',[$thirty, $today])->get(); 
	    $value = $get->count();
 }
$days1=[];
$value1=[];
foreach($get as $g){
	$check=DB::table('orders')->where('locking_date',$g->locking_date)->where('order_status','=',1)->count();

	$days1[]=date('d F Y', strtotime($g->locking_date));
	$value1[]=$check;
	
}
$checkd=array('value'=>$value1,'date'=>$days1);
 
    return $checkd;
}
	
	
  public static function newclient($check_date)
  {
    
   
  $today = date('Y-m-d');
	 $latest= date('Y-m-d', strtotime('-9 days'));
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		// dd($seventh_day);
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));

if($check_date != NULL){
    if($check_date == "overall"){
    $get=DB::table('users')->get(); 
	$value = $get->count();
   }elseif($check_date == "thirty_days"){
   	 $get=DB::table('users')->whereBetween('created_at',[$thirty, $today])->get(); 
	$value = $get->count();
   }elseif($check_date == "ninety_days"){
   	 $get=DB::table('users')->whereBetween('created_at',[$ninety, $today])->get();
	$value = $get->count();

   }else{
      $get=DB::table('users')->whereBetween('created_at',[$seventh_day, $today])->get(); 
	    $value = $get->count();
   }
 }else{
 	$get=DB::table('users')->whereBetween('created_at',[$thirty, $today])->get(); 
	    $value = $get->count();
 }



    return $value;

	 
  }	


    public static function newclientGraph($check_date)
  {
    
    $today = date('Y-m-d');
	  $yesterday=date('Y-m-d', strtotime('-1 days'));
		$seventh_day = date('Y-m-d', strtotime('-6 days'));
		$eighth_day = date('Y-m-d', strtotime('-7 days'));
		$thirty = date('Y-m-d', strtotime('-29 days'));
		$thirtyone=date('Y-m-d', strtotime('-30 days'));
		$ninety = date('Y-m-d', strtotime('-89 days'));
		$ninetyone = date('Y-m-d', strtotime('-90 days'));
    $latest= date('Y-m-d', strtotime('-9 days'));
if($check_date != NULL){
   if($check_date == "thirty_days"){
   	 
   	 $dateRange = CarbonPeriod::create($thirty, $today);
   	 $dateRange2 = CarbonPeriod::create($thirtyone, $yesterday);
	

   }else{
      
      $dateRange = CarbonPeriod::create($seventh_day, $today);
   	 $dateRange2 = CarbonPeriod::create($eighth_day, $yesterday);
   }
 }else{
 	
   	$dateRange = CarbonPeriod::create($thirty, $today);
   	 $dateRange2 = CarbonPeriod::create($thirtyone, $yesterday);
	   
 }
$days1=[];
$value1=[];
$value2=[];
$d=json_encode($dateRange->toArray());
$k=json_decode($d);
$count=count($k);
foreach($k as $dd){
  $date1[]=date('d F Y', strtotime($dd));
	$gs=date('Y-m-d', strtotime($dd));
	$check=DB::table('users')->whereDate('created_at',$gs)->count();
	$value1[]=$check;
}

$d2=json_encode($dateRange2->toArray());
$k2=json_decode($d2);
  foreach($k2 as $dd2){
       $date1[]=date('d F Y', strtotime($dd2));
	   $gs2=date('Y-m-d', strtotime($dd2));
	   $check2=DB::table('users')->whereDate('created_at',$gs2)->count();
	   $value2[]=$check2;
   }
	$checkd=array('value'=>$value1,'date'=>$date1,'date1'=>$date1,'value2'=>$value2);
    return $checkd;
}

	
}