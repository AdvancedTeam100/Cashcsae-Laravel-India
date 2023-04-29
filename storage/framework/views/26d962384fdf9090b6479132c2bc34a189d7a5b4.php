 <?php ($neworders=\DB::table('orders')->where('notify',0)->get()); ?>

<?php ($newwd=\DB::table('withdrawal_reqs')->where('approved',0)->where('notify',0)->get()); ?>
<?php ($cont=\DB::table('users')->where('is_phone_verified',0)->where('notify',0)->get()); ?>
<?php ($sc=\DB::table('offers')->where('notify',0)->get()); ?>
<?php ($sr=\DB::table('cuelink_campaigns')->where('notify',0)->get()); ?>
<?php ($or=\DB::table('cuelink_offers')->where('notify',0)->get()); ?>
<?php ($com=\DB::table('complains')->where('complain',0)->where('notify',0)->get()); ?>
<?php ($adv=\DB::table('partners')->where('notify',0)->get()); ?>

 <?php ($name=\App\Models\BusinessSetting::where('key','currency')->first()->value); ?>
 <?php ($currency=\App\Models\Currency::where('currency_code',$name)->first()); ?>
<?php $result=array();
   
foreach($neworders as $new){
	$newcheck=array('id'=>1,'title'=>'New Order','message'=>'New Order Created ('.$new->partner_order_id.').','dated'=>date('F jS, Y', strtotime($new->created_at)));
	array_push($result,$newcheck);
}
foreach($newwd as $new1){
	$newcheck1=array('id'=>2,'title'=>'Withdrawal request','message'=>'New Withdrawal Request Received ('.$currency->currency_symbol.$new1->amount.').','dated'=>date('F jS, Y', strtotime($new1->created_at)) );
	array_push($result,$newcheck1);
}
foreach($cont as $new2){
	$newcheck2=array('id'=>3,'title'=>'New User','message'=>'New User Registered ('.$new2->phone.').','dated'=>date('F jS, Y', strtotime($new2->created_at)));
	array_push($result,$newcheck2);
}
foreach($sc as $new3){
	$newcheck3=array('id'=>4,'title'=>'New Ad','message'=>'New Advertisement Added ('.$new3->name.').','dated'=>date('F jS, Y', strtotime($new3->created_at)));
	array_push($result,$newcheck3);
}
foreach($sr as $new4){
	$newcheck4=array('id'=>5,'title'=>'New Campaign','message'=>'New Campaign Added ('.$new4->name.').','dated'=>date('F jS, Y', strtotime($new4->created_at)));
	array_push($result,$newcheck4);
}
foreach($or as $new5){
	$newcheck5=array('id'=>6,'title'=>'New Offer','message'=>'New Offer Added ('.$new5->name.').','dated'=>date('F jS, Y', strtotime($new5->created_at)));
	array_push($result,$newcheck5);
}

foreach($adv as $new6){
	$newcheck6=array('id'=>7,'title'=>'New Advertiser','message'=>'New Advertiser Added ('.$new6->name.').','dated'=>date('F jS, Y', strtotime($new6->created_at)));
	array_push($result,$newcheck6);
}

foreach($com as $new7){
	$newcheck7=array('id'=>8,'title'=>'New Complaint','message'=>'New Complaint received ('.$new7->complain.').','dated'=>date('F jS, Y', strtotime($new7->created_at)));
	array_push($result,$newcheck7);
}
$result = collect($result)->sortByDesc('dated')->all();





?>
 <header class="navbar navbar-expand-md navbar-light d-print-none navbar-fixed fixed">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              <?php ($logo=\App\Models\BusinessSetting::where('key','logo')->first()->value); ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
              <img src="<?php echo e(asset('storage/app/public/info/'.$logo)); ?>" width="110" height="32" alt="Cashfuse" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
			    <?php if(\App\CentralLogics\Helpers::module_permission_check('notifications')): ?>
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="<?php echo e(Route('admin.notification.index')); ?>" class="notification" target="_blank" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
   <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
</svg> 
                  Send Notification
                </a>
              </div>
            </div>
			     <?php endif; ?>
            <div class="d-none d-md-flex">
					<div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                  <?php if(count($sr) > 0 || count($sc) > 0 || count($newwd)>0 || count($neworders)>0 || count($cont)>0 || count($or)>0 || count($com)>0 || count($adv)>0): ?><span class="badge bg-red"><?php echo e(count($sr) + count($sc) + count($newwd) + count($neworders) + count($cont) + count($or) + count($com) + count($adv)); ?></span> <?php endif; ?> 
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">latest updates</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
						 <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
                      <div class="list-group-item">
						 
                        <div class="row align-items-center">
                          <div class="col-auto"><span <?php if($res['id']==1 || $res['id'] == 6 || $res['id'] == 7 ): ?> class="status-dot status-dot-animated bg-green d-block" <?php endif; ?> <?php if($res['id']==2): ?> class="status-dot status-dot-animated bg-yellow d-block" <?php endif; ?> <?php if($res['id']==3): ?> class="status-dot status-dot-animated bg-orange d-block" <?php endif; ?> <?php if($res['id']==4 || $res['id']==8): ?> class="status-dot status-dot-animated bg-red d-block" <?php endif; ?> <?php if($res['id']==5): ?> class="status-dot status-dot-animated bg-black d-block" <?php endif; ?>></span></div>
                          <div class="col text-truncate">
                            <a <?php if($res['id']==1): ?> href="<?php echo e(url('/records/orders')); ?>" <?php endif; ?> <?php if($res['id']==2): ?> href="<?php echo e(url('/records/withdraw_requests')); ?>" <?php endif; ?> <?php if($res['id']==3): ?> href="<?php echo e(url('/customer/list')); ?>" <?php endif; ?> <?php if($res['id']==4): ?> href="<?php echo e(url('/ads/list')); ?>" <?php endif; ?> <?php if($res['id']==5): ?> href="<?php echo e(url('/cuelinkscampaigns/list')); ?>" <?php endif; ?> <?php if($res['id']==6): ?> href="<?php echo e(url('/cuelinksoffers/list')); ?>" <?php endif; ?> <?php if($res['id']==7): ?> href="<?php echo e(url('/advertiser/list')); ?>" <?php endif; ?> <?php if($res['id']==8): ?> href="<?php echo e(url('/records/complaint')); ?>" <?php endif; ?> class="text-body d-block"><?php echo e($res['title']); ?></a>
                            <div class="d-block text-muted mt-n1">
                              <?php echo e($res['message']); ?>

                            </div>
                          </div>
                          <div class="col-auto">                           
                             <?php echo e(date('d F',strtotime($res['dated']))); ?>

                          </div>
                        </div>
                      </div>
						  
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
              <img class="avatar avatar-sm"
                                        onerror="this.src='<?php echo e(asset('assets/theme_assets/img')); ?>/upload1.png'"
                                        src="<?php echo e(asset('storage/app/public/admin/'.auth('admin')->user()->image)); ?>" alt="logo image" style="margin: 7px !important;"/>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
              

              
                
                <div class="d-none d-xl-block ps-2">
                  <div> <?php echo e(auth('admin')->user()->f_name); ?></div>
                  <div class="mt-1 small text-muted"> <?php echo e(auth('admin')->user()->email); ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?php echo e(route('admin.settings')); ?>" class="dropdown-item">Profile Settings</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('admin.auth.logout')); ?>" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header><?php /**PATH C:\xampp\htdocs\admitad_cashfuse\resources\views/admin/layout/header.blade.php ENDPATH**/ ?>