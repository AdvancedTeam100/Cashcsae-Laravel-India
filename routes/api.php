<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api'], function () {


     Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login_or_register', 'CustomerAuthController@register_step1');
        Route::post('register', 'CustomerAuthController@register');
        Route::post('verify-phone', 'CustomerAuthController@verify_phone');

        Route::post('check-email', 'CustomerAuthController@check_email');
        Route::post('verify-email', 'CustomerAuthController@verify_email');

        Route::post('forgot-password', 'PasswordResetController@reset_password_request');
        Route::post('verify-token', 'PasswordResetController@verify_token');
        Route::put('reset-password', 'PasswordResetController@reset_password_submit');
		 
		 Route::post('login_with_email', 'CustomerAuthController@login_with_email');
		 Route::post('social_login','AuthCustomerController@social_login');
		 Route::get('/verify/{token}','AuthCustomerController@verifyAccount')->name('email.verify');
       });
	   
      Route::group(['prefix' => 'app_info'], function () {
        Route::get('/', 'ConfigController@configuration');
         });
	
	 Route::group(['prefix' => 'adnetwork'], function () {
                Route::get('fbads', 'AdmobController@fbads');
                Route::get('admob_settings', 'AdmobController@admobs');
            });
	
	Route::post('update-profile', 'ConfigController@update_profile');
    Route::get('getadvs', 'AdsController@getadvs'); 
	Route::get('getalloffers', 'CueController@getalloffers');
	Route::get('getallbanners', 'CueController@getallbanners');
	Route::get('alladv', 'CueController@alladv');
	Route::get('topcashback', 'CueController@topcashback');
	Route::get('homeadv', 'CueController@homepartner');
	Route::get('exclusiveoffers', 'CueController@exclusiveoffers');
	Route::get('getcategory', 'CueController@getcategory');
	Route::get('getallcampaigns', 'CueController@getallcampaigns');
	Route::get('getallpartner', 'CueController@getallpartner');
	
	Route::get('offer_details', 'CueController@offer_details');
	Route::get('ads_details', 'CueController@ads_details');
	Route::get('campaigns_details', 'CueController@campaigns_details');
	
	Route::get('about_us', 'ConfigController@about_us');
	Route::get('privacy_policy', 'ConfigController@privacy_policy');
	
	Route::get('allin', 'AllinController@allin');
	Route::get('faq', 'AllinController@faq');
	Route::get('coupon', 'AllinController@coupon');
	Route::post('search', 'AllinController@search');
	
	Route::post('add_bank_detail', 'UserController@add_bank_detail');
	Route::post('add_upi_detail', 'UserController@add_upi_detail');
	Route::post('add_paytm_detail', 'UserController@add_paytm_detail');
	Route::post('add_amazon_detail', 'UserController@add_amazon_detail');
	Route::get('get_bank_detail', 'UserController@get_bank_detail');
	Route::get('get_tracking_link', 'UserController@get_tracking_link');
	Route::get('get_impact_link', 'UserController@get_impact_link');
	Route::get('get_click', 'UserController@get_click');
	Route::post('add_click', 'UserController@add_click');
	Route::get('my_profile', 'UserController@my_profile');
	Route::post('send_withdrawal_request', 'UserController@send_withdrawal_request');
	Route::get('payment_history', 'UserController@payment_history');
	Route::get('order_history', 'UserController@order_history');
	
	Route::get('remove_user_from_db', 'UserController@remove_user');
	
	Route::post('add_paypal_detail', 'UserController@add_paypal_detail');
	
	Route::get('bannernotification', 'BannernotificationController@bannernotification');
	
	Route::post('add_complain', 'ComplainController@add_complain');
	Route::get('get_order_complain', 'ComplainController@get_order_complain');
	
	Route::get('delete_clicks', 'ConfigController@deleteclicks');
	Route::get('delete_all_clicks', 'ConfigController@deleteallclicks');
	
	Route::get('seemorecampaigns', 'CueController@seemorecampaigns');
	Route::get('seemoreoffers', 'CueController@seemoreoffers');
	Route::get('seemoreads', 'CueController@seemorads');
	
	Route::get('referral_users', 'ReferralController@referrals');
	
	Route::get('trending_keywords', 'SearchController@trending');
	Route::get('seemoradmitadoffers', 'CueController@seemoradmitadoffers');
	Route::get('getalladmitadcampaigns', 'CueController@getalladmitadcampaigns');
	Route::get('admitadoffer_details', 'CueController@admitadoffer_details');

	Route::get('get_products', 'ProductapiController@getProducts');
	Route::get('get_trending_products', 'ProductapiController@getTrendingProducts');

     });