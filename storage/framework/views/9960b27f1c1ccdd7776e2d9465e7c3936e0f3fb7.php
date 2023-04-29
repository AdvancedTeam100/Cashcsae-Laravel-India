
<?php  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json'); ?>
<?php $__env->startSection('title','Dashboard'); ?>
   
<?php
	foreach ($params as $key =>$value) {
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
<?php $__env->startPush('css_or_js'); ?>
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            position: absolute;
            font-size: 10px;
            background: #865439;
            color: #ffffff;
            width: 60px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px; 
        }
     
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-header d-print-none" style="border-bottom:none !important">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
             
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">

          <div class="row row-deck row-cards" id="order_stats">
            <?php echo $__env->make('admin.partials._dashboard-order-stats',['sales'=>$sales,'revenue'=>$revenue,'ordgv'=>$ordgv,'ordgd'=>$ordgd,'newuser'=>$newuser,'ncgv'=>$ncgv,'ncgv2'=>$ncgv2,'ncgd'=>$ncgd,'userrevenue'=>$userrevenue,'usrevgv'=>$usrevgv,'usrevgd'=>$usrevgd], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              
			  <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                   <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                   <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                                </svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                             <?php echo e($totalcam); ?> Campaigns
                            </div>
                            <div class="text-muted">
                              <?php echo e($todaycam); ?> Today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                                   <line x1="12" y1="12" x2="20" y2="7.5"></line>
                                   <line x1="12" y1="12" x2="12" y2="21"></line>
                                   <line x1="12" y1="12" x2="4" y2="7.5"></line>
                                   <line x1="16" y1="5.25" x2="8" y2="9.75"></line>
                                </svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                             <?php echo e($totaloffers); ?> offers
                            </div>
                            <div class="text-muted">
                             <?php echo e($todayoffers); ?> today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-social" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <circle cx="12" cy="5" r="2"></circle>
                               <circle cx="5" cy="19" r="2"></circle>
                               <circle cx="19" cy="19" r="2"></circle>
                               <circle cx="12" cy="14" r="3"></circle>
                               <line x1="12" y1="7" x2="12" y2="11"></line>
                               <line x1="6.7" y1="17.8" x2="9.5" y2="15.8"></line>
                               <line x1="17.3" y1="17.8" x2="14.5" y2="15.8"></line>
                            </svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                             <?php echo e($totalads); ?> Ads
                            </div>
                            <div class="text-muted">
                              <?php echo e($todayads); ?> today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-youtube text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                               <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin-rupee" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <circle cx="12" cy="12" r="9"></circle>
   <path d="M15 8h-6h1a3 3 0 0 1 0 6h-1l3 3"></path>
   <path d="M9 11h6"></path>
</svg>
                             
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                             <?php echo e($totalwqs); ?> Withdrawals
                            </div>
                            <div class="text-muted">
                              <?php echo e($todaywqs); ?> Today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-linkedin text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-octagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M8.7 3h6.6c.3 0 .5 .1 .7 .3l4.7 4.7c.2 .2 .3 .4 .3 .7v6.6c0 .3 -.1 .5 -.3 .7l-4.7 4.7c-.2 .2 -.4 .3 -.7 .3h-6.6c-.3 0 -.5 -.1 -.7 -.3l-4.7 -4.7c-.2 -.2 -.3 -.4 -.3 -.7v-6.6c0 -.3 .1 -.5 .3 -.7l4.7 -4.7c.2 -.2 .4 -.3 .7 -.3z"></path>
   <line x1="12" y1="8" x2="12" y2="12"></line>
   <line x1="12" y1="16" x2="12.01" y2="16"></line>
</svg>
                         </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php echo e($totalcoms); ?> complaints
                            </div>
                            <div class="text-muted">
                              <?php echo e($todaycoms); ?> today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-2">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-click" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <line x1="3" y1="12" x2="6" y2="12"></line>
   <line x1="12" y1="3" x2="12" y2="6"></line>
   <line x1="7.8" y1="7.8" x2="5.6" y2="5.6"></line>
   <line x1="16.2" y1="7.8" x2="18.4" y2="5.6"></line>
   <line x1="7.8" y1="16.2" x2="5.6" y2="18.4"></line>
   <path d="M12 12l9 3l-4 2l-2 4l-3 -9"></path>
</svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              <?php echo e($totalclicks); ?> clicks
                            </div>
                            <div class="text-muted">
                             <?php echo e($todayclicks); ?> today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  
			  
			  <div class="col-12 col-md-6 col-lg-6">
                <div class="card">

					<div class="card-header">
					<h2 class="page-title" style="float:left; width: 100%;">
                         Customer Withdraw Requests List
                      </h2>
					 <a  style="float:right !important;" href="<?php echo e(route('admin.records.withdraw_requests')); ?>" class="btn btn-primary  float-right">View All</a></div>
              <div class="card-body">
                <div class="table" style="width:100%">
                  <table id="example2" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Amount</button></th>
						  <th><button class="table-sort" data-sort="sort-email">Withdraw Medium</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Status</button></th>
                        <th><button class="table-sort" data-sort="sort-role">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                  
                           <?php $__currentLoopData = $reqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="row"><?php echo e($k+$reqs->firstItem()); ?></td>
                              
                             
                                    <td class="sort-name"><?php echo e($e->user['name']); ?></td>
                                     <td class="sort-email"><?php echo e($e['amount']); ?>

										</td>
									<td class="sort-email"><b><?php echo e($e['medium']); ?></b><br><?php echo $e['medium_details']; ?>

										</td>
                                     <td class="sort-phone"><?php if($e['approved']==0): ?> <p style="color:orange">Not Approved Yet</p><?php elseif($e['approved']==2): ?> <p style="color:red">Rejected </p><?php else: ?>  <p style="color:green">Approved</p><?php endif; ?>
									</td>
                                      <td class="sort-phone"><?php if($e['approved']==0): ?> <a href="<?php echo e(route('admin.customer.approve_withdraw_requests',$e['id'])); ?>" class="btn btn-primary" >Approve</a>&nbsp;&nbsp; <a href="<?php echo e(route('admin.customer.reject_withdraw_requests',$e['id'])); ?>" class="btn btn-danger" >Reject</a><?php elseif($e['approved']==2): ?> <p style="color:red">Rejected </p><?php else: ?>  <p style="color:green">Approved</p><?php endif; ?>
									</td>
                                   
                                </tr>
						<!-- Modal -->
								
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
              
            </div>
              </div>
			    <div class="col-12 col-md-6 col-lg-6">
				  <div class="card">
                 <div class="card-header">
					<h2 class="page-title" align="left" style="width: 100%;">
                        Customer Complain List
                      </h2>
					 <a  align="right" style="float:right !important;" href="<?php echo e(route('admin.records.complaint')); ?>" class="btn btn-primary  float-right">View All</a></div>
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Order Id</button></th>
						  <th><button class="table-sort" data-sort="sort-email">Complain</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Status</button></th>
                        <th><button class="table-sort" data-sort="sort-role">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      
                           <?php $__currentLoopData = $complains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="row"><?php echo e($k+$complains->firstItem()); ?></td>
                              
                             
                                    <td class="sort-name"><?php echo e($e['user']['name']?? 'user deleted'); ?></td>
                                     <td class="sort-email"><?php echo e($e['order_id']); ?>

										</td>
									<td class="sort-email"><b><?php echo e($e['complain']); ?></b>
										</td>
                                     <td class="sort-phone"><?php if($e['status']==0): ?> <p style="color:orange">Not Replied Yet</p><?php else: ?>  <p style="color:green">Replied</p><?php endif; ?>
									</td>
                                      <td class="sort-phone"><?php if($e['status']==0): ?> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo e($e->id); ?>">
										  Reply</button><?php else: ?>  <p style="color:green">Replied<br><b style="color:black">Reply: </b><span style="color:black"><?php echo e($e['reply']); ?></span></p><?php endif; ?>
									</td>
                                   
                                </tr>
						
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
             
            </div>
                
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="card">
					<div class="card-header">
					<h2 class="page-title" align="left" style="width: 100%;">
                        Customer Clicks List
                      </h2>
					 <a  align="right" style="float:right !important;" href="<?php echo e(route('admin.records.clicks')); ?>" class="btn btn-primary  float-right">View All</a></div>
                
              <div class="card-body">
               <div class="table" style="width:100%">
                  <table id="example3" class="display" style="width:100%">
                    <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                        <th><button class="table-sort" data-sort="sort-email">Click Id</button></th>
						  <th><button class="table-sort" data-sort="sort-email">image</button></th>
                        <th><button class="table-sort" data-sort="sort-phone">Url</button></th>
						    <th><button class="table-sort" data-sort="sort-phone">Created At</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
               
                           <?php $__currentLoopData = $clicks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="row"><?php echo e($k+$clicks->firstItem()); ?></td>
                              
                             
                                    <td class="sort-name"><?php echo e($e['user']['name']?? 'user deleted'); ?></td>
                                     <td class="sort-email"><?php echo e($e['id']); ?>

										</td>
									<td class="sort-email"><img width="100px" src="<?php echo e($e['image']); ?>" onerror="this.src='<?php echo e(url('/')); ?>/storage/app/public/images/noimage.png'" alt="no image" >
										</td>
                                     <td class="sort-email"><span><?php echo e($e['tracking_link']); ?> </span>
										</td>
									
									 <td class="sort-email"><?php echo e(date('d-M-Y',strtotime($e['created_at']))); ?>

										</td>
                                   
                                </tr>
						
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
              
            </div>
              </div>
              <div class="col-12">
                    <div class="card">
                <div class="card-header">
					<h2 class="page-title" align="left" style="width: 100%;">
                        Customer Orders List
                      </h2>
					 <a  align="right" style="float:right !important;" href="<?php echo e(route('admin.records.orders')); ?>" class="btn btn-primary  float-right">View All</a></div>
              <div class="card-body">
                 <div class="table" style="width:100%">
                  <table id="example4" class="display" style="width:100%">
                  <thead>
                      <tr>
                         <th><button class="table-sort" data-sort="sort-s">#</button></th>
						 <th><button class="table-sort" data-sort="sort-name">Image</button></th>
                         <th><button class="table-sort" data-sort="sort-name">User</button></th>
                         <th><button class="table-sort" data-sort="sort-email">Order Id</button></th>
						 <th><button class="table-sort" data-sort="sort-id">Partner Order Id</button></th>
						 <th><button class="table-sort" data-sort="sort-phone">Advertiser</button></th>
                         <th><button class="table-sort" data-sort="sort-partner">Affiliate partner</button></th>
						  <th><button class="table-sort" data-sort="sort-order">Comission Status</button></th>
						 <th><button class="table-sort" data-sort="sort-order">Order Amount</button></th>
						  <th><button class="table-sort" data-sort="sort-url">Admin Earning</button></th>
				         <th><button class="table-sort" data-sort="sort-earning">User Earning</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
             
                           <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td id="row" class="sort-s"><?php echo e($k+$orders->firstItem()); ?></td>
									  <td>
                                 
                               <img src="<?php echo e(asset('storage/app/public/partner')); ?>/<?php echo e($e['logo']); ?>" alt="no image" style="width:80px">
                              
                                </td>
                                    <td class="sort-name"> <?php echo e($e['user']['name']?? 'user deleted'); ?> </td>
                                     <td class="sort-email"> <?php echo e($e['id']); ?></td>
									<td class="sort-id"> <?php echo e($e['partner_order_id']); ?></td>
									<td class="sort-phone"> <?php echo e($e['advertisers']); ?></td>
									<td class="sort-partner"> <b><?php echo e($e['affiliate_partner']); ?></b></td>
									<td class="sort-url"> <b><?php if($e['order_status']==0): ?> <span style="color:orange">Pending </span> <?php elseif($e['order_status']==1): ?>  <span style="color:green">Approved </span> <?php else: ?>  <span style="color:red">Rejected </span> <?php endif; ?></b></td>
									<td class="sort-order"> <b><?php echo e($e['order_amount']); ?></b></td>
										<td class="sort-url"> <b><?php echo e($e['admin_earn']); ?></b></td>
									<td class="sort-earning"> <b><?php echo e($e['earning_amount']); ?></b></td>
                                </tr>
								
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
              
            </div>
              </div>
			  
                  </div>
                </div>
              </div>
             
       <?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
          function order_stats_update(type) {
        $.ajax({
 url: '<?php echo e(url('admin')); ?>'+'?statistics_type='+type,
 type: "GET",
 success: function(data){
  alert(data[message]);
 },
 error: function(data){
  alert("error!");
 }
});
}
     </script>
<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('team-chart1'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Total Orders",
                data: <?php echo json_encode($ordgv, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($ordgd, 15, 512) ?>,
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>


 
<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "Approved",
                data: <?php echo json_encode($revgv, 15, 512) ?>
            },{
                name: "Pending",
                data: <?php echo json_encode($pgv, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($revgd, 15, 512) ?>,
            colors: ["#206bc4", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>


<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('act-user-bg'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "Approved",
                data: <?php echo json_encode($usrevgv, 15, 512) ?>
            },{
                name: "Pending",
                data: <?php echo json_encode($usrpgv, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($usrevgd, 15, 512) ?>,
            colors: ["#206bc4", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>
     

    <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "this day",
                data: <?php echo json_encode($ncgv, 15, 512) ?>
            },{
                name: "previous day",
                data: <?php echo json_encode($ncgv2, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($ncgd, 15, 512) ?>,
            colors: ["#206bc4", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>



    

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Xampp2\htdocs\Backend-codes\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>