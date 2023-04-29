<div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul id="myMenu" class="navbar-nav" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item <?php echo e(Request::is('/')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(Route('admin.dashboard')); ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Dashboard
                    </span>
                  </a>
                </li>
                <?php if(\App\CentralLogics\Helpers::module_permission_check('allin') || \App\CentralLogics\Helpers::module_permission_check('homeadv') || \App\CentralLogics\Helpers::module_permission_check('banner') || \App\CentralLogics\Helpers::module_permission_check('faq') || \App\CentralLogics\Helpers::module_permission_check('app_popup') || \App\CentralLogics\Helpers::module_permission_check('pages')): ?>
                <li class="nav-item dropdown <?php echo e(Request::is('role*')?'active':''); ?> <?php echo e(Request::is('team*')?'active':''); ?> ">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M10 3h4v4h-4z"></path>
                     <path d="M3 17h4v4h-4z"></path>
                     <path d="M17 17h4v4h-4z"></path>
                     <path d="M7 17l5 -4l5 4"></path>
                     <line x1="12" y1="7" x2="12" y2="13"></line>
                  </svg>
                    </span>
                    <span class="nav-link-title">
                      App Settings
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <?php if(\App\CentralLogics\Helpers::module_permission_check('allin')): ?>
                            <a class="dropdown-item <?php echo e(Request::is('admin/allin*')?'active':''); ?>" href="<?php echo e(url('/allin/index')); ?>">All in One Search</a>
						  <?php endif; ?>
						    <?php if(\App\CentralLogics\Helpers::module_permission_check('app_popup')): ?>
						  <a class="dropdown-item <?php echo e(Request::is('admin/notification/bannernotification')?'active':''); ?>" href="<?php echo e(Route('admin.notification.bannernotification')); ?>">App Pop-Up</a>
						  <?php endif; ?>
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('homeadv')): ?>
                            <a class="dropdown-item <?php echo e(Request::is('admin/homeadv*')?'active':''); ?>" href="<?php echo e(Route('admin.homeadv.list')); ?>">App Homepage Settings</a>
						  <?php endif; ?>
						  
						 </div>
                         <div class="dropdown-menu-column">
						   
						     <?php if(\App\CentralLogics\Helpers::module_permission_check('banner')): ?>
						   <a class="dropdown-item <?php echo e(Request::is('admin/banner*')?'active':''); ?>" href="<?php echo e(Route('admin.banner.list')); ?>">Banner</a>
						  <?php endif; ?>
							  
						
					 <?php if(\App\CentralLogics\Helpers::module_permission_check('pages')): ?>	  
						<div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Pages
                           
                          </a>
                          <div class="dropdown-menu">
                           <a class="dropdown-item  <?php echo e(Request::is('admin/info-settings/privacy_policy')?'active':''); ?>" href="<?php echo e(Route('admin.info-settings.privacy_policy')); ?>">Privacy Policy</a>
                           <a class="dropdown-item  <?php echo e(Request::is('admin/info-settings/privacy_policy')?'active':''); ?>" href="<?php echo e(Route('admin.info-settings.about_us')); ?>">About Us</a>
                          </div>
                        </div>
                      <?php endif; ?>
						  
						 
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('faq')): ?>
                           <a class="dropdown-item <?php echo e(Request::is('admin/faq*')?'active':''); ?>" href="<?php echo e(url('/faq/list')); ?>">FAQs</a>
						  <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </li>
				  <?php endif; ?>
            
               
				   <?php if(\App\CentralLogics\Helpers::module_permission_check('category')): ?>
                <li class="nav-item  <?php echo e(Request::is('category*')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(route('admin.category.list')); ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <rect x="2" y="13" width="8" height="8" rx="2"></rect>
   <path d="M6 13v3"></path>
   <rect x="8" y="3" width="8" height="8" rx="2"></rect>
   <path d="M12 3v3"></path>
   <rect x="14" y="13" width="8" height="8" rx="2"></rect>
   <path d="M18 13v3"></path>
</svg>
                    </span>
                    <span class="nav-link-title">
                       Category
                    </span>
                  </a>
                </li>
                <?php endif; ?>
                 <?php if(\App\CentralLogics\Helpers::module_permission_check('customerList')): ?>
                <li class="nav-item  <?php echo e(Request::is('customer*')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(Route('admin.customer.list')); ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-happy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <circle cx="12" cy="12" r="9"></circle>
   <line x1="9" y1="9" x2="9.01" y2="9"></line>
   <line x1="15" y1="9" x2="15.01" y2="9"></line>
   <path d="M8 13a4 4 0 1 0 8 0m0 0h-8"></path>
</svg>
                    </span>
                    <span class="nav-link-title">
                      Users
                    </span>
                  </a>
                </li>
                <?php endif; ?>
                 <?php if(\App\CentralLogics\Helpers::module_permission_check('advertiser')): ?>
                 <li class="nav-item  <?php echo e(Request::is('advertiser*')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(Route('admin.advertiser.list')); ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-nerd" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <circle cx="12" cy="12" r="9"></circle>
                     <circle cx="8" cy="10" r="2"></circle>
                     <circle cx="16" cy="10" r="2"></circle>
                     <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                     <path d="M3.5 9h2.5"></path>
                     <path d="M18 9h2.5"></path>
                     <path d="M10 9.5c1.333 -1.333 2.667 -1.333 4 0"></path>
                  </svg>
                    </span>
                    <span class="nav-link-title">
                      Advertiser
                    </span>
                  </a>
                </li>
                <?php endif; ?> 
				   <?php if(\App\CentralLogics\Helpers::module_permission_check('ads')): ?>
                 <li class="nav-item  <?php echo e(Request::is('ads*')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(Route('admin.ads.list')); ?>" >
                   <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-medal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M12 4v3m-4 -3v6m8 -6v6"></path>
   <path d="M12 18.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5z"></path>
</svg>
                    </span>
                    <span class="nav-link-title">
                      Ads
                    </span>
                  </a>
                </li>
                <?php endif; ?> 
                 <?php if(\App\CentralLogics\Helpers::module_permission_check('coupon')): ?>
                <li class="nav-item  <?php echo e(Request::is('admin/coupon*')?'active':''); ?>">
                  <a class="nav-link" href="<?php echo e(url('/coupon/list')); ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <rect x="2" y="13" width="8" height="8" rx="2"></rect>
   <path d="M6 13v3"></path>
   <rect x="8" y="3" width="8" height="8" rx="2"></rect>
   <path d="M12 3v3"></path>
   <rect x="14" y="13" width="8" height="8" rx="2"></rect>
   <path d="M18 13v3"></path>
</svg>
                    </span>
                    <span class="nav-link-title">
                       Coupon
                    </span>
                  </a>
                </li>
                <?php endif; ?>
              
                 <?php if(\App\CentralLogics\Helpers::module_permission_check('impact')): ?>
               <li class="nav-item dropdown <?php echo e(Request::is('impact*')?'active':''); ?> <?php echo e(Request::is('impactadvertisor*')?'active':''); ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                       <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                       <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                       <line x1="14" y1="7" x2="20" y2="7"></line>
                       <line x1="17" y1="4" x2="17" y2="10"></line>
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Impact
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
						   <a class="dropdown-item  <?php echo e(Request::is('impact-setup*')?'active':''); ?>" href="<?php echo e(route('admin.impact.impact-setup')); ?>">
                          Settings
                        </a>
                        <a class="dropdown-item  <?php echo e(Request::is('impactadvertisor*')?'active':''); ?>" href="<?php echo e(route('admin.impactadvertiser.add')); ?>">
                          Advertiser
                        </a>
                        <a class="dropdown-item  <?php echo e(Request::is('impactads*')?'active':''); ?>" href="<?php echo e(route('admin.impactads.list')); ?>">
                          Ads
                        </a> 
                      </div>
                    </div>
                  </div>
                </li>
                <?php endif; ?>
				  
				    <?php if(\App\CentralLogics\Helpers::module_permission_check('cuelink')): ?>
               <li class="nav-item dropdown <?php echo e(Request::is('cuelink*')?'active':''); ?> <?php echo e(Request::is('impactadvertisor*')?'active':''); ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                       <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                       <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                       <line x1="14" y1="7" x2="20" y2="7"></line>
                       <line x1="17" y1="4" x2="17" y2="10"></line>
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Cuelinks
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
						   <a class="dropdown-item  <?php echo e(Request::is('cuelinks/setup*')?'active':''); ?>" href="<?php echo e(route('admin.cuelinks.setup')); ?>">
                          Settings
                        </a>
						    <a class="dropdown-item  <?php echo e(Request::is('cuelinksadvertisers*')?'active':''); ?>" href="<?php echo e(route('admin.cuelinksadvertisers.list')); ?>">
                          Advertisers
                        </a> 
						  <a class="dropdown-item  <?php echo e(Request::is('cuelinkscampaigns*')?'active':''); ?>" href="<?php echo e(route('admin.cuelinkscampaigns.list')); ?>">
                          Campaigns
                        </a> 
                        <a class="dropdown-item  <?php echo e(Request::is('cuelinksoffers*')?'active':''); ?>" href="<?php echo e(route('admin.cuelinksoffers.list')); ?>">
                          Offers
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </li>
                <?php endif; ?>


                <?php if(\App\CentralLogics\Helpers::module_permission_check('admitad')): ?>
               <li class="nav-item dropdown <?php echo e(Request::is('admitad*')?'active':''); ?> <?php echo e(Request::is('admitadadvertisor*')?'active':''); ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                       <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                       <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                       <line x1="14" y1="7" x2="20" y2="7"></line>
                       <line x1="17" y1="4" x2="17" y2="10"></line>
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Admitad
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
						   <a class="dropdown-item  <?php echo e(Request::is('admitad/setup*')?'active':''); ?>" href="<?php echo e(route('admin.admitad.setup')); ?>">
                          Settings
                        </a>
						    <a class="dropdown-item  <?php echo e(Request::is('admitadadvertisers*')?'active':''); ?>" href="<?php echo e(route('admin.admitadadvertisers.list')); ?>">
                          Advertisers
                        </a> 
						  <a class="dropdown-item  <?php echo e(Request::is('admitadcampaigns*')?'active':''); ?>" href="<?php echo e(route('admin.admitadcampaigns.list')); ?>">
                          Campaigns
                        </a> 
                      </div>
                    </div>
                  </div>
                </li>
                <?php endif; ?>
				 <?php if(\App\CentralLogics\Helpers::module_permission_check('settings') || \App\CentralLogics\Helpers::module_permission_check('referral') || \App\CentralLogics\Helpers::module_permission_check('currency') || \App\CentralLogics\Helpers::module_permission_check('notifications') || \App\CentralLogics\Helpers::module_permission_check('team') || \App\CentralLogics\Helpers::module_permission_check('role') || \App\CentralLogics\Helpers::module_permission_check('withdrawal') || \App\CentralLogics\Helpers::module_permission_check('clicks') || \App\CentralLogics\Helpers::module_permission_check('orders') || \App\CentralLogics\Helpers::module_permission_check('dispute') || \App\CentralLogics\Helpers::module_permission_check('trending')): ?> 
				   <li class="nav-item dropdown  <?php echo e(Request::is('admin/info-settings/info-setup*')?'active':''); ?>  <?php echo e(Request::is('admin/banner*')?'active':''); ?> <?php echo e(Request::is('admin/homeadv*')?'active':''); ?> <?php echo e(Request::is('admin/allin*')?'active':''); ?><?php echo e(Request::is('admin/faq*')?'active':''); ?><?php echo e(Request::is('admin/coupon*')?'active':''); ?>">
                  <a class="nav-link dropdown-toggle" href="#settings" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					   <circle cx="6" cy="10" r="2"></circle>
					   <line x1="6" y1="4" x2="6" y2="8"></line>
					   <line x1="6" y1="12" x2="6" y2="20"></line>
					   <circle cx="12" cy="16" r="2"></circle>
					   <line x1="12" y1="4" x2="12" y2="14"></line>
					   <line x1="12" y1="18" x2="12" y2="20"></line>
					   <circle cx="18" cy="7" r="2"></circle>
					   <line x1="18" y1="4" x2="18" y2="5"></line>
					   <line x1="18" y1="9" x2="18" y2="20"></line>
					</svg>
                    </span>
                    <span class="nav-link-title">
                      Others
                    </span>
                  </a>
                  <div class="dropdown-menu" class="navbar-base" id="navbar-base">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                         <?php if(\App\CentralLogics\Helpers::module_permission_check('settings')): ?>
                            <a class="dropdown-item <?php echo e(Request::is('admin/info-settings/info-setup')?'active':''); ?>" href="<?php echo e(Route('admin.info-settings.info-setup')); ?>">Master Settings</a>
						  <?php endif; ?>
						  
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('referral')): ?>
                            <a class="dropdown-item <?php echo e(Request::is('admin/referral-settings/referral-setup')?'active':''); ?>" href="<?php echo e(Route('admin.referral-settings.referral-setup')); ?>">Referral Settings</a>
						  <?php endif; ?>
						  
						 <?php if(\App\CentralLogics\Helpers::module_permission_check('currency')): ?>
                            <a class="dropdown-item <?php echo e(Request::is('admin/info-settings/currency-setup')?'active':''); ?>" href="<?php echo e(Route('admin.info-settings.currency-setup')); ?>">Currency Settings</a>
						  <?php endif; ?>
						    <?php if(\App\CentralLogics\Helpers::module_permission_check('notifications')): ?>
						  <a class="dropdown-item <?php echo e(Request::is('admin/fcm/index')?'active':''); ?>" href="<?php echo e(Route('admin.fcm.index')); ?>">Firebase Settings</a>
						  <?php endif; ?>
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('team') || \App\CentralLogics\Helpers::module_permission_check('role')): ?>
						   <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Team
                           
                          </a>
                          <div class="dropdown-menu">
							  <?php if(\App\CentralLogics\Helpers::module_permission_check('role')): ?>
                        <a class="dropdown-item  <?php echo e(Request::is('role*')?'active':''); ?>" href="<?php echo e(route('admin.role.create')); ?>">
                          Team Roles
                        </a>
                        <?php endif; ?>
                        <?php if(\App\CentralLogics\Helpers::module_permission_check('team')): ?>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle <?php echo e(Request::is('team*')?'active':''); ?>" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Teams
                          </a>
                          <div class="dropdown-menu">
                            <a href="<?php echo e(route('admin.team.list')); ?>" class="dropdown-item <?php echo e(Request::is('team/list*')?'active':''); ?>">
                              Team Member List
                            </a>
                            <a href="<?php echo e(route('admin.team.add-new')); ?>" class="dropdown-item <?php echo e(Request::is('team/add*')?'active':''); ?>">
                               Add Team Member
                            </a>
                          </div>
                        </div>
                       <?php endif; ?>
                          </div>
                        </div>
						  <?php endif; ?>
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('ad_network') || \App\CentralLogics\Helpers::module_permission_check('admob')|| \App\CentralLogics\Helpers::module_permission_check('fbads')): ?>
						   <div class="dropend">
                          <a class="dropdown-item dropdown-toggle <?php echo e(Request::is('ad_network*')?'active':''); ?> <?php echo e(Request::is('admob*')?'active':''); ?> <?php echo e(Request::is('fbads*')?'active':''); ?>" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Ad Network
                           
                          </a>
                          <div class="dropdown-menu">
					    <?php if(\App\CentralLogics\Helpers::module_permission_check('ad_network')): ?>
                        <a class="dropdown-item  <?php echo e(Request::is('ad_network*')?'active':''); ?>" href="<?php echo e(route('admin.ad_network.settings')); ?>">
                         Settings
                        </a>
                        <?php endif; ?>
					    <?php if(\App\CentralLogics\Helpers::module_permission_check('admob')): ?>
                        <a class="dropdown-item  <?php echo e(Request::is('admob*')?'active':''); ?>" href="<?php echo e(route('admin.admob.setup')); ?>">
                         Admob
                        </a>
                        <?php endif; ?>
					     <?php if(\App\CentralLogics\Helpers::module_permission_check('fbads')): ?>
                        <a class="dropdown-item  <?php echo e(Request::is('fbads*')?'active':''); ?>" href="<?php echo e(route('admin.fbads.setup')); ?>">
                         Facebook Ads
                        </a>
                        <?php endif; ?>
                       
                          </div>
                        </div>
						  <?php endif; ?>
                      </div>
                      <div class="dropdown-menu-column">
						 
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('withdrawal')): ?>
						   <a class="dropdown-item <?php echo e(Request::is('admin/records/withdraw_requests*')?'active':''); ?>" href="<?php echo e(Route('admin.records.withdraw_requests')); ?>">Withdrawal Requests</a>
						  <?php endif; ?>
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('clicks')): ?>
						   <a class="dropdown-item <?php echo e(Request::is('admin/records/clicks*')?'active':''); ?>" href="<?php echo e(Route('admin.records.clicks')); ?>">Click Management</a>
						  <?php endif; ?>
						   <?php if(\App\CentralLogics\Helpers::module_permission_check('orders')): ?>
						   <a class="dropdown-item <?php echo e(Request::is('admin/records/orders*')?'active':''); ?>" href="<?php echo e(Route('admin.records.orders')); ?>">Order management</a>
						  <?php endif; ?>
						  <?php if(\App\CentralLogics\Helpers::module_permission_check('dispute')): ?>
						   <a class="dropdown-item <?php echo e(Request::is('admin/records/complaint*')?'active':''); ?>" href="<?php echo e(Route('admin.records.complaint')); ?>">Dispute Management</a>
						  <?php endif; ?>
						  <?php if(\App\CentralLogics\Helpers::module_permission_check('trending')): ?>
						  <a class="dropdown-item <?php echo e(Request::is('admin/trending*')?'active':''); ?>" href="<?php echo e(Route('admin.trending.index')); ?>">Trending Search</a>
						  <?php endif; ?>
                          
                      </div>
                    </div>
                  </div>
                </li>
				<?php endif; ?>  
               
              
              </ul>
              
            </div>
          </div>
        </div>
      </div><?php /**PATH C:\xampp\htdocs\admitad_cashfuse\resources\views/admin/layout/navbar.blade.php ENDPATH**/ ?>