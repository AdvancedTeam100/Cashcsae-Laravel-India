<?php  
     foreach ($params as $key => $value) {
            if ($key == 'sales') {
                $sa = $params['sales'];
           }else{
              $sa="thirty_days";
            }
		 
             if ($key == 'admin_earning') {
                $reven = $params['admin_earning'];
           }else{
              $reven="thirty_days";
            }

            if ($key == 'new_user') {
                $new = $params['new_user'];
           }else{
              $new="thirty_days";
            }
            if ($key == 'user_earning') {
                $ac = $params['user_earning'];
           }else{
              $ac="thirty_days";
            }
           
            }
          
      
  ?> 
 <?php ($name=\App\Models\BusinessSetting::where('key','currency')->first()->value); ?>
 <?php ($currency=\App\Models\Currency::where('currency_code',$name)->first()); ?>
<div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Orders</div>
                       <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if($params['sales']=="seven_days"): ?> 7 days <?php endif; ?> <?php if($params['sales']=="thirty_days"): ?> 30 days <?php endif; ?> <?php if($params['sales']=="ninety_days"): ?> 90 days <?php endif; ?> <?php if($params['sales']=="overall"): ?> Overall <?php endif; ?></a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=seven_days&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 7 days</a>
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=thirty_days&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 30 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=ninety_days&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 90 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=overall&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Overall</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="h1 mb-3"><?php echo e($sales); ?></div>
                  </div>
                  <div id="team-chart1" class="chart-sm"></div>
                </div>
              </div>
              
<div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Admin Earning</div>
                       <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if($params['admin_earning']=="seven_days"): ?> 7 days <?php endif; ?> <?php if($params['admin_earning']=="thirty_days"): ?> 30 days <?php endif; ?> <?php if($params['admin_earning']=="ninety_days"): ?> 90 days <?php endif; ?> <?php if($params['admin_earning']=="overall"): ?> Overall <?php endif; ?></a>
                          <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=seven_days&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 7 days</a>
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=thirty_days&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 30 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=ninety_days&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Last 90 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=overall&new_user=<?php echo e($new); ?>&user_earning=<?php echo e($ac); ?>">Overall</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-3 me-2"><?php echo e($currency->currency_symbol); ?><?php echo e(round($revenue,0)); ?></div>
                      <div class="me-auto">
                        <span class="text-red d-inline-flex align-items-center lh-1">
                          <?php echo e($currency->currency_symbol); ?><?php echo e(round($revenue1,0)); ?><!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                          pending
                        </span>
                      </div>
                    </div>
                    
                  </div>
                  <div id="chart-revenue-bg" class="chart-mentions"></div>
                </div>
              </div>
     <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Users Earning</div>
                       <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if($params['user_earning']=="seven_days"): ?> 7 days <?php endif; ?> <?php if($params['user_earning']=="thirty_days"): ?> 30 days <?php endif; ?> <?php if($params['user_earning']=="ninety_days"): ?> 90 days <?php endif; ?> <?php if($params['user_earning']=="overall"): ?> Overall <?php endif; ?></a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=seven_days">Last 7 days</a>
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=thirty_days">Last 30 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=ninety_days">Last 90 days</a>
                            <a class="dropdown-item"  href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=<?php echo e($new); ?>&user_earning=overall">Overall</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-3 me-2"><?php echo e($currency->currency_symbol); ?><?php echo e(round($userrevenue,2)); ?></div>
                       <div class="me-auto">
                        <span class="text-red d-inline-flex align-items-center lh-1">
                          <?php echo e($currency->currency_symbol); ?><?php echo e(round($userrevenue1,0)); ?><!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                          pending
                        </span>
                      </div>
                    </div>
                    
                  </div>
                  <div id="act-user-bg" class="chart-mentions"></div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">New users</div>
                       <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if($params['new_user']=="seven_days"): ?> 7 days <?php endif; ?> <?php if($params['new_user']=="thirty_days"): ?> 30 days <?php endif; ?></a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=seven_days&user_earning=<?php echo e($ac); ?>">Last 7 days</a>
                            <a class="dropdown-item" href="<?php echo e(url('/')); ?>?sales=<?php echo e($sa); ?>&admin_earning=<?php echo e($reven); ?>&new_user=thirty_days&user_earning=<?php echo e($ac); ?>">Last 30 days</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-3 me-2"><?php echo e($newuser); ?></div>
                    
                    </div>
                    
                  </div>
                  <div id="chart-new-clients" class="chart-sm"></div>
                </div>
              </div>

            <?php /**PATH C:\xampp\htdocs\Codefuse\ecom\cashfuse-new\resources\views/admin/partials/_dashboard-order-stats.blade.php ENDPATH**/ ?>