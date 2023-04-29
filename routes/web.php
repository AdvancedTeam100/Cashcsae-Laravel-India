<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/clear-all', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache, route, view, config is cleared";
});
Route::group(['namespace' => 'Installer'], function () {
Route::get('verifyLicense', 'InstallerController@verifyLicense')->name('verifyLicense');

Route::get('installFinish', 'InstallerController@installFinish')->name('installFinish');
Route::get('verification', 'InstallerController@requirement')->name('verification');
Route::get('requirement', 'InstallerController@requirement');
Route::get('verify', 'InstallerController@verify')->name('verify');
Route::post('verifyPost', 'InstallerController@verifyPost')->name('verifyPost');
Route::get('databaseinst', 'InstallerController@databaseinst')->name('databaseinst');
Route::post('databasePost', 'InstallerController@databasePost')->name('databasePost');

    Route::post('databaseVerifyPost', function () {
        Artisan::call('config:cache');
        Artisan::call('config:clear');

        return app(\App\Http\Controllers\Installer\InstallerController::class)->databaseVerifyPost();
    });
  });

Route::group(['prefix' => 'install'], function () {
    Route::post('settings', 'InstallController@system_settings')->name('system_settings');
      });


   Route::group(['namespace' => 'Admin','middleware' => ['verifylicense'], 'as' => 'admin.'], function () {
    Route::get('admitad', 'AdmitadController@index')->name('admitad');
    Route::get('couponfetch', 'AdmitadController@couponfetch')->name('couponfetch');


	Route::get('cuelinkautofetchorders', 'OrderController@cuelinkautofetchorders')->name('cuelinkautofetchorders');
	Route::get('impactautofetchorders', 'OrderController@impactautofetchorders')->name('impactautofetchorders');
	Route::get('getcampaigns', 'AutofetchController@autofetchcampaigns')->name('getcampaigns');
	Route::get('getoffers', 'AutofetchController@autofetchoffers')->name('getoffers');
    	Route::get('getbrands', 'AutofetchController@autofetchbrands')->name('getbrands');
	Route::get('getads', 'AutofetchController@autofetchads')->name('getads');
    Route::group(['namespace' => 'Auth','as' => 'auth.'], function () {
        Route::get('/', 'LoginController@login')->name('login');
        Route::post('login_success', 'LoginController@submit');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/', 'LoginController@login')->name('login');
        Route::post('login_success', 'LoginController@submit')->name('logincheck');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::get('get_categories', 'OfferController@get_categories')->name('get_categories');
           
});
 Route::group(['middleware' => ['admin']], function () {
    Route::get('settings', 'SystemController@settings')->name('settings');
        Route::post('settings', 'SystemController@settings_update');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
      

	     Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::group(['middleware' => ['module:banner']], function () {
                Route::get('add', 'BannerController@index')->name('add');
				 Route::get('list', 'BannerController@list')->name('list');
                Route::post('store', 'BannerController@store')->name('store');
                Route::get('edit/{id}', 'BannerController@edit')->name('edit');
                Route::post('update/{id}', 'BannerController@update')->name('update');
                Route::get('delete/{id}', 'BannerController@delete')->name('delete');
                Route::post('search', 'BannerController@search')->name('search');
                Route::get('export-all', 'BannerController@exportbanners')->name('export-all');
            });
        });

	 
	     Route::group(['prefix' => 'coupon', 'as' => 'coupon.'], function () {
            Route::group(['middleware' => ['module:coupon']], function () {
                Route::get('add', 'CouponController@index')->name('add');
				Route::get('list', 'CouponController@list')->name('list');
                Route::post('store', 'CouponController@store')->name('store');
                Route::get('edit/{id}', 'CouponController@edit')->name('edit');
                Route::post('update/{id}', 'CouponController@update')->name('update');
                Route::get('delete/{id}', 'CouponController@delete')->name('delete');
                Route::post('search', 'CouponController@search')->name('search');
                Route::get('export-all', 'CouponController@exportcoupon')->name('export-all');
            });
        });
	 
     Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
      Route::group(['prefix' => 'role', 'as' => 'role.', 'middleware' => ['module:role']], function () {
            Route::get('create', 'CustomRoleController@create')->name('create');
            Route::post('create', 'CustomRoleController@store');
            Route::get('edit/{id}', 'CustomRoleController@edit')->name('edit');
            Route::post('update/{id}', 'CustomRoleController@update')->name('update');
            Route::get('delete/{id}', 'CustomRoleController@distroy')->name('delete');
            Route::post('search', 'CustomRoleController@search')->name('search');
        });

        Route::group(['prefix' => 'team', 'as' => 'team.', 'middleware' => ['module:team']], function () {
            Route::get('add-new', 'TeamController@add_new')->name('add-new');
            Route::post('added', 'TeamController@store')->name('added');
            Route::get('list', 'TeamController@list')->name('list');
            Route::get('update/{id}', 'TeamController@edit')->name('edit');
            Route::post('update/{id}', 'TeamController@update')->name('update');
            Route::get('delete/{id}', 'TeamController@distroy')->name('delete');
            Route::post('search', 'TeamController@search')->name('search');
            Route::get('export-all', 'TeamController@exportteam')->name('export-all');
        });

        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('get-all', 'CategoryController@get_all')->name('get-all');
            Route::group(['middleware' => ['module:category']], function () {
                Route::get('add', 'CategoryController@index')->name('add');
				Route::post('update_cat_img/{id}', 'CategoryController@update_cat_img')->name('update_cat_img');
                Route::get('add-sub-category', 'CategoryController@sub_index')->name('add-sub-category');
				 Route::get('list', 'CategoryController@liste')->name('list');
                Route::get('sub-category-list', 'CategoryController@sub_list')->name('sub-category-list');
                Route::post('store', 'CategoryController@store')->name('store');
                Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
                Route::post('update/{id}', 'CategoryController@update')->name('update');
                Route::post('store', 'CategoryController@store')->name('store');
                Route::get('delete/{id}', 'CategoryController@delete')->name('delete');
                Route::post('search', 'CategoryController@searchcategory')->name('search');
                Route::get('export-all', 'CategoryController@exportcategory')->name('export-all');
            });
        });
	 
	  Route::group(['prefix' => 'trending', 'as' => 'trending.'], function () {
         Route::group(['middleware' => ['module:trending']], function () {
                Route::get('index', 'TrendingController@index')->name('index');
                Route::post('store', 'TrendingController@store')->name('store');
                Route::get('delete/{id}', 'TrendingController@delete')->name('delete');
          });
        });

            Route::group(['prefix' => 'info-settings', 'as' => 'info-settings.'], function () {
				Route::group(['middleware' => ['module:settings']], function () {
                Route::get('info-setup', 'SettingsController@business_index')->name('info-setup');
                Route::post('update-setup', 'SettingsController@business_setup')->name('update-setup');
				 });
				Route::group(['middleware' => ['module:pages']], function () {
				 Route::get('about_us', 'SettingsController@about_us')->name('about_us');
                Route::post('update_about_us', 'SettingsController@about_us_update')->name('update_about_us');
				 Route::get('privacy_policy', 'SettingsController@privacy_policy')->name('privacy_policy');
                Route::post('update_privacy_policy', 'SettingsController@privacy_policy_update')->name('update_privacy_policy');
					 });
            });
	 
	        Route::group(['prefix' => 'info-settings', 'as' => 'info-settings.', 'middleware' => ['module:currency']], function () {
			    Route::get('currency-setup', 'SettingsController@currency_index')->name('currency-setup');
                Route::post('update-currency', 'SettingsController@currency_setup')->name('update-currency');
				Route::post('exchange_rate', 'SettingsController@exchange_rate')->name('exchange_rate');
            });
	 
	   Route::group(['prefix' => 'referral-settings', 'as' => 'referral-settings.', 'middleware' => ['module:referral']], function () {
			    Route::get('referral-setup', 'SettingsController@referral_index')->name('referral-setup');
                Route::post('update-referral', 'SettingsController@referral_setup')->name('update-referral');
            });
	 
	     Route::group(['prefix' => 'impact', 'as' => 'impact.', 'middleware' => ['module:impact']], function () {
                Route::get('impact-setup', 'ImpactsettingController@index')->name('impact-setup');
                Route::post('update', 'ImpactsettingController@update')->name('update');
			 Route::get('check', 'ImpactsettingController@check')->name('check');
            });
        Route::group(['prefix' => 'customer', 'as' => 'customer.','middleware' => ['module:customerList']], function() {
            Route::group(['middleware' => ['module:customerList']], function () {
              Route::get('list', 'CustomerController@customer_list')->name('list');
				Route::get('edit/{id}', 'CustomerController@edit')->name('edit');
                Route::post('update/{id}', 'CustomerController@update')->name('update');
				Route::post('update_img/{id}', 'CustomerController@update_img')->name('update_img');
              Route::get('status/{customer}/{status}', 'CustomerController@status')->name('status');
				Route::get('approve_withdraw_requests/{id}', 'CustomerController@approve_withdraw_requests')->name('approve_withdraw_requests');
				Route::get('reject_withdraw_requests/{id}', 'CustomerController@reject_withdraw_requests')->name('reject_withdraw_requests');
				Route::post('reply/{id}', 'CustomerController@reply')->name('reply');
				Route::get('profile/{id}', 'CustomerController@user_profile')->name('profile');
				Route::get('deleteclicks', 'CustomerController@deleteclicks')->name('deleteclicks');
			    Route::post('search', 'CustomerController@searchuser')->name('search');
                Route::get('export-all', 'CustomerController@exportcustomer')->name('export-all');
                Route::get('exportorders', 'CustomerController@exportorders')->name('exportorders');
                Route::get('exportwithdrawal', 'CustomerController@exportwithdrawal')->name('exportwithdrawal');
                Route::get('exportclicks', 'CustomerController@exportclick')->name('exportclicks');
            });
         });
	 
	  Route::group(['prefix' => 'records', 'as' => 'records.'], function() {
		     Route::group(['middleware' => ['module:withdrawal']], function () {
				Route::get('withdraw_requests', 'CustomerController@withdraw_requests')->name('withdraw_requests');
			 });
		     Route::group(['middleware' => ['module:orders']], function () {
                 Route::get('orders', 'CustomerController@orders')->name('orders');
			 });
		       Route::group(['middleware' => ['module:dispute']], function () {
				 Route::get('complaint', 'CustomerController@complains')->name('complaint');
		       });
		      Route::group(['middleware' => ['module:clicks']], function () {
				Route::get('clicks', 'CustomerController@clicks')->name('clicks');
			  });
        
         });

         Route::group(['prefix' => 'advertiser', 'as' => 'advertiser.'], function () {
            Route::group(['middleware' => ['module:advertiser']], function () {
                Route::get('add', 'PartnerController@index')->name('add');
				Route::post('update_tagline/{id}', 'PartnerController@update_tagline')->name('update_tagline');
				Route::get('top_cashback/{partner}/{top_cashback}', 'PartnerController@top_cashback')->name('top_cashback');
				Route::get('list', 'PartnerController@list')->name('list');
                Route::post('store', 'PartnerController@store')->name('store');
                Route::get('edit/{id}', 'PartnerController@edit')->name('edit');
                Route::post('update/{id}', 'PartnerController@update')->name('update');
                Route::post('store', 'PartnerController@store')->name('store');
                Route::get('delete/{id}', 'PartnerController@delete')->name('delete');
                Route::post('search', 'PartnerController@searchadvertisers')->name('search');
				Route::post('update_comission/{id}', 'PartnerController@update_comission')->name('update_comission');
                Route::get('export-all', 'PartnerController@exportadvertiser')->name('export-all');
				 Route::get('active_status/{partner}/{status}', 'PartnerController@active_status')->name('active_status');
            });
        });
         Route::group(['prefix' => 'ads', 'as' => 'ads.', 'middleware' => ['module:ads']], function () {
            Route::get('add-new', 'OfferController@add_new')->name('add-new');
            Route::post('added', 'OfferController@store')->name('added');
            Route::get('list', 'OfferController@list')->name('list');
            Route::get('update/{id}', 'OfferController@edit')->name('edit');
            Route::post('update/{id}', 'OfferController@update')->name('update');
            Route::get('delete/{id}', 'OfferController@distroy')->name('delete');
            Route::post('search', 'OfferController@searchads')->name('search');
            Route::get('export-all', 'OfferController@exportads')->name('export-all');
        });
	 
	 Route::group(['prefix' => 'impactadvertiser', 'as' => 'impactadvertiser.'], function () {
            Route::group(['middleware' => ['module:impact']], function () {
                Route::get('list', 'ImpactController@index')->name('add');
                Route::get('edit/{id}', 'ImpactController@editp')->name('edit');
				Route::post('search', 'ImpactController@searchadvertisers')->name('search');
            });
        });
	 
	   Route::group(['prefix' => 'impactads', 'as' => 'impactads.', 'middleware' => ['module:impact']], function () {
          
            Route::get('list', 'ImpactController@list')->name('list');
            Route::get('update/{id}', 'ImpactController@edit')->name('edit');
            Route::post('update/{id}', 'ImpactController@update')->name('update');
            Route::get('delete/{id}', 'ImpactController@distroy')->name('delete');
            Route::post('search', 'ImpactController@search')->name('search');
		    Route::get('status/{impact}/{status}', 'ImpactController@status')->name('status');

            Route::get('export-all-advertiser', 'ImpactController@exportadvertisers')->name('export-all-advertiser');
            Route::get('export-all', 'ImpactController@exportads')->name('export-all');
        });
	 
	  Route::group(['prefix' => 'cuelinksoffers', 'as' => 'cuelinksoffers.', 'middleware' => ['module:cuelink']], function () {
          
            Route::get('list', 'CuelinkController@list')->name('list');
		    Route::get('exclusive/{offers}/{exclusive}', 'CuelinkController@exclusive')->name('exclusive');
		    Route::get('offer_status/{offers}/{status}', 'CuelinkController@offer_status')->name('offer_status');
		  Route::post('update_offer_img/{id}', 'CuelinkController@update_offer_img')->name('update_offer_img');
		   Route::get('delete/{id}', 'CuelinkController@distroy')->name('delete');
            Route::get('export-all', 'CuelinkController@exportoffers')->name('export-all');

        });
	 Route::group(['prefix' => 'cuelinkscampaigns', 'as' => 'cuelinkscampaigns.', 'middleware' => ['module:cuelink']], function () {
          
            Route::get('list', 'CuelinkController@index')->name('list'); 
		 Route::post('update_cam_img/{id}', 'CuelinkController@update_cam_img')->name('update_cam_img');
		 Route::post('update_desc/{id}', 'CuelinkController@update_desc')->name('update_desc');
         Route::get('export-all', 'CuelinkController@exportcampaign')->name('export-all');
            Route::get('update/{id}', 'ImpactController@edit')->name('edit');
            Route::post('update/{id}', 'ImpactController@update')->name('update');
            Route::get('delete/{id}', 'ImpactController@distroy')->name('delete');
            Route::post('search', 'ImpactController@search')->name('search');
           
		    Route::get('campagns-status/{offers}/{status}', 'CuelinkController@campagns_status')->name('campagns_status');

        });
	   Route::group(['prefix' => 'cuelinksadvertisers', 'as' => 'cuelinksadvertisers.', 'middleware' => ['module:cuelink']], function () {
          
            Route::get('list', 'CuelinkController@listadv')->name('list');
            Route::get('update/{id}', 'ImpactController@edit')->name('edit');
            Route::post('update/{id}', 'ImpactController@update')->name('update');
            Route::get('delete/{id}', 'ImpactController@distroy')->name('delete');
            Route::post('search', 'ImpactController@search')->name('search');
            Route::get('export-all-advertiser', 'CuelinkController@exportadvertisers')->name('export-all-advertiser');
        });

        Route::group(['prefix' => 'homeadv', 'as' => 'homeadv.'], function () {
            Route::group(['middleware' => ['module:homeadv']], function () {
                Route::get('add', 'HomeadvController@index')->name('add');
                Route::get('list', 'HomeadvController@list')->name('list');
                Route::post('store', 'HomeadvController@store')->name('store');
                Route::get('edit/{id}', 'HomeadvController@edit')->name('edit');
                Route::post('update/{id}', 'HomeadvController@update')->name('update');
                Route::post('store', 'HomeadvController@store')->name('store');
                Route::get('delete/{id}', 'HomeadvController@delete')->name('delete');
                Route::post('search', 'HomeadvController@search')->name('search');
				Route::post('change-postion', 'HomeadvController@changePostion')->name('change-postion');
            });
        });
	 
        Route::group(['prefix' => 'Country', 'as' => 'country.'], function () {
            Route::group(['middleware' => ['module:country']], function () {
                Route::get('index', [CountryController::class, 'index'])->name('index');
                Route::get('edit/{id}', [CountryController::class, 'edit'])->name('edit');
                Route::post('store', [CountryController::class, 'store'])->name('store');                
                Route::post('update', [CountryController::class, 'update'])->name('update');                
                Route::get('delete/{id}', [CountryController::class, 'delete'])->name('delete');
                
            });
        });
        Route::group(['prefix' => 'Language', 'as' => 'language.'], function () {
            Route::group(['middleware' => ['module:country']], function () {
                Route::get('index', [LanguageController::class, 'index'])->name('index');
                Route::get('edit/{id}', [LanguageController::class, 'edit'])->name('edit');
                Route::post('store', [LanguageController::class, 'store'])->name('store');                
                Route::post('update/{id}', [LanguageController::class, 'update'])->name('update');                
                Route::get('delete/{id}', [LanguageController::class, 'delete'])->name('delete');
                
            });
        });
	 
	   Route::group(['prefix' => 'cuelinks', 'as' => 'cuelinks.', 'middleware' => ['module:cuelinks']], function () {
                Route::get('setup', 'CuelinksettingsController@index')->name('setup');
                Route::post('update', 'CuelinksettingsController@update')->name('update');
			 Route::get('check', 'CuelinksettingsController@check')->name('check');
            });
	 
	  Route::group(['prefix' => 'allin', 'as' => 'allin.'], function () {
            Route::group(['middleware' => ['module:allin']], function () {
                Route::get('index', 'AllinController@index')->name('add');
                Route::post('store', 'AllinController@store')->name('store');
                Route::get('delete/{id}', 'AllinController@delete')->name('delete');
				Route::post('update/{id}', 'AllinController@update')->name('update');
                
            });
        });
	 
	  Route::group(['prefix' => 'faq', 'as' => 'faq.'], function () {
            Route::group(['middleware' => ['module:faq']], function () {
                Route::get('add', 'FaqController@index')->name('add');
				 Route::get('list', 'FaqController@liste')->name('list');
                Route::post('store', 'FaqController@store')->name('store');
                Route::get('edit/{id}', 'FaqController@edit')->name('edit');
                Route::post('update/{id}', 'FaqController@update')->name('update');
                Route::get('delete/{id}', 'FaqController@delete')->name('delete');
                Route::get('export-all', 'FaqController@exportfaq')->name('export-all');
            });
        });
	 
	  Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {
            Route::group(['middleware' => ['module:notification']], function () {
                Route::get('index', 'NotificationController@index')->name('index');
                Route::post('send', 'NotificationController@send')->name('send');
				 });
			Route::group(['middleware' => ['module:app_popup']], function () {
				 Route::get('bannernotification', 'NotificationController@bannernotification')->name('bannernotification');
				Route::post('storebanner', 'NotificationController@storebanner')->name('storebanner');
            });
        });
	 
	   Route::group(['prefix' => 'fcm', 'as' => 'fcm.'], function () {
            Route::group(['middleware' => ['module:fcm']], function () {
                Route::get('index', 'NotificationController@fcmindex')->name('index');
                Route::post('store', 'NotificationController@store')->name('store');
            });
        });
	 
	  Route::group(['prefix' => 'ad_network', 'as' => 'ad_network.', 'middleware' => ['module:ad_network']], function () {
                Route::get('settings', 'AdnetworkController@settings')->name('settings');
                Route::post('update-setup', 'AdnetworkController@update_setup')->name('update-setup');
            });
	 
	       Route::group(['prefix' => 'admob', 'as' => 'admob.', 'middleware' => ['module:admob']], function () {
                Route::get('setup', 'AdnetworkController@index')->name('setup');
                Route::post('update/{id}', 'AdnetworkController@update')->name('update');
            });
	 
	     Route::group(['prefix' => 'fbads', 'as' => 'fbads.', 'middleware' => ['module:fbads']], function () {
                Route::get('setup', 'FbController@index')->name('setup');
                Route::post('update/{id}', 'FbController@update')->name('update');
            });


            Route::group(['prefix' => 'admitad', 'as' => 'admitad.', 'middleware' => ['module:admitad']], function () {
                Route::get('setup', 'AdmitadsettingsController@index')->name('setup');
                Route::post('update', 'AdmitadsettingsController@update')->name('update');
			    Route::get('check', 'AdmitadsettingsController@check')->name('check');
            });

            Route::group(['prefix' => 'admitadadvertisers', 'as' => 'admitadadvertisers.', 'middleware' => ['module:admitad']], function () {
          
                Route::get('list', 'AdmitaddataController@listadv')->name('list');
                Route::get('update/{id}', 'ImpactController@edit')->name('edit');
                Route::post('update/{id}', 'ImpactController@update')->name('update');
                Route::get('delete/{id}', 'ImpactController@distroy')->name('delete');
                Route::post('search', 'ImpactController@search')->name('search');
                Route::get('export-all-advertiser', 'AdmitaddataController@exportadvertisers')->name('export-all-advertiser');
            });

            Route::group(['prefix' => 'admitadcampaigns', 'as' => 'admitadcampaigns.', 'middleware' => ['module:admitad']], function () {
          
                Route::get('list', 'AdmitaddataController@index')->name('list'); 
             Route::post('update_cam_img/{id}', 'AdmitaddataController@update_cam_img')->name('update_cam_img');
             Route::post('update_desc/{id}', 'AdmitaddataController@update_desc')->name('update_desc');
             Route::get('export-all', 'AdmitaddataController@exportcampaign')->name('export-all');
             Route::get('status/{admitad}/{status}', 'AdmitaddataController@status')->name('status');
    
            });
	 
	 Route::group(['prefix' => 'coupons', 'as' => 'coupons.', 'middleware' => ['module:admitad']], function () {
          
               Route::get('cuelink/list', 'CuelinkController@coupan')->name('coupan');
              Route::get('admitad/list', 'AdmitaddataController@coupan')->name('admi_coupan');
    
            });

            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
           
                Route::group(['middleware' => ['module:product']], function () {
                    Route::get('add', 'ProductController@index')->name('add');
                     Route::get('list', 'ProductController@liste')->name('list');
                    Route::post('store', 'ProductController@store')->name('store');
                    Route::get('edit/{id}', 'ProductController@edit')->name('edit');
                    Route::post('update/{id}', 'ProductController@update')->name('update');
                    Route::get('delete/{id}', 'ProductController@delete')->name('delete');
                    Route::post('search', 'ProductController@searchcategory')->name('search');
                    Route::get('export-all', 'ProductController@exportcategory')->name('export-all');
                    Route::get('active/{id}', 'ProductController@active')->name('active');					
             		 Route::get('trending/{product}/{trending}', 'ProductController@trending')->name('trending');
					 Route::get('delete_product_image/{id}', 'ProductController@delete_product_image')->name('delete_product_image');
                });
            });
	 
  });
});

