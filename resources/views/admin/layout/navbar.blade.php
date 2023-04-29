<div class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
      <div class="container-xl">
        <ul id="myMenu" class="navbar-nav" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item {{Request::is('/')?'active':''}}">
            <a class="nav-link" href="{{Route('admin.dashboard')}}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <polyline points="5 12 3 12 12 3 21 12 19 12" />
                  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                  <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
              </span>
              <span class="nav-link-title">Dashboard</span>
            </a>
          </li>
          @if(\App\CentralLogics\Helpers::module_permission_check('allin') ||
          \App\CentralLogics\Helpers::module_permission_check('homeadv') ||
          \App\CentralLogics\Helpers::module_permission_check('banner') ||
          \App\CentralLogics\Helpers::module_permission_check('faq') ||
          \App\CentralLogics\Helpers::module_permission_check('app_popup') ||
          \App\CentralLogics\Helpers::module_permission_check('pages'))
          <li class="nav-item dropdown {{Request::is('role*')?'active':''}} {{Request::is('team*')?'active':''}} ">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hierarchy-2" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M10 3h4v4h-4z"></path>
                  <path d="M3 17h4v4h-4z"></path>
                  <path d="M17 17h4v4h-4z"></path>
                  <path d="M7 17l5 -4l5 4"></path>
                  <line x1="12" y1="7" x2="12" y2="13"></line>
                </svg>
              </span>
              <span class="nav-link-title"> App Settings</span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  @if(\App\CentralLogics\Helpers::module_permission_check('allin'))
                  <a class="dropdown-item {{Request::is('admin/allin*')?'active':''}}"
                    href="{{ url('/allin/index') }}">All in One Search</a>
                  @endif
                  @if(\App\CentralLogics\Helpers::module_permission_check('app_popup'))
                  <a class="dropdown-item {{Request::is('admin/notification/bannernotification')?'active':''}}"
                    href="{{Route('admin.notification.bannernotification')}}">App Pop-Up</a>
                  @endif
                  @if(\App\CentralLogics\Helpers::module_permission_check('homeadv'))
                  <a class="dropdown-item {{Request::is('admin/homeadv*')?'active':''}}"
                    href="{{ Route('admin.homeadv.list') }}">App Homepage Settings</a>
                  @endif

                </div>
                <div class="dropdown-menu-column">

                  @if(\App\CentralLogics\Helpers::module_permission_check('banner'))
                  <a class="dropdown-item {{Request::is('admin/banner*')?'active':''}}"
                    href="{{Route('admin.banner.list')}}">Banner</a>
                  @endif


                  @if(\App\CentralLogics\Helpers::module_permission_check('pages'))
                  <div class="dropend">
                    <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown"
                      data-bs-auto-close="outside" role="button" aria-expanded="false"> Pages</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item  {{Request::is('admin/info-settings/privacy_policy')?'active':''}}"
                        href="{{Route('admin.info-settings.privacy_policy')}}">Privacy Policy</a>
                      <a class="dropdown-item  {{Request::is('admin/info-settings/privacy_policy')?'active':''}}"
                        href="{{Route('admin.info-settings.about_us')}}">About Us</a>
                    </div>
                  </div>
                  @endif


                  @if(\App\CentralLogics\Helpers::module_permission_check('faq'))
                  <a class="dropdown-item {{Request::is('admin/faq*')?'active':''}}"
                    href="{{ url('/faq/list') }}">FAQs</a>
                  @endif
                </div>
              </div>
            </div>
          </li>
          @endif


          @if(\App\CentralLogics\Helpers::module_permission_check('category'))
          <li class="nav-item  {{Request::is('category*')?'active':''}}">
            <a class="nav-link" href="{{route('admin.category.list')}}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <rect x="2" y="13" width="8" height="8" rx="2"></rect>
                  <path d="M6 13v3"></path>
                  <rect x="8" y="3" width="8" height="8" rx="2"></rect>
                  <path d="M12 3v3"></path>
                  <rect x="14" y="13" width="8" height="8" rx="2"></rect>
                  <path d="M18 13v3"></path>
                </svg>
              </span>
              <span class="nav-link-title">Category</span>
            </a>
          </li>
          @endif
          @if(\App\CentralLogics\Helpers::module_permission_check('customerList'))
          <li class="nav-item  {{Request::is('customer*')?'active':''}}">
            <a class="nav-link" href="{{Route('admin.customer.list')}}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-happy" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="12" cy="12" r="9"></circle>
                  <line x1="9" y1="9" x2="9.01" y2="9"></line>
                  <line x1="15" y1="9" x2="15.01" y2="9"></line>
                  <path d="M8 13a4 4 0 1 0 8 0m0 0h-8"></path>
                </svg>
              </span>
              <span class="nav-link-title"> Users</span>
            </a>
          </li>
          @endif
         
     

      



          {{-- start Manual Campagin --}}
          @if(\App\CentralLogics\Helpers::module_permission_check('coupon') ||
          \App\CentralLogics\Helpers::module_permission_check('ads') ||
          \App\CentralLogics\Helpers::module_permission_check('admitad'))
          <li
            class="nav-item dropdown {{Request::is('admin/coupon*')?'active':''}} {{Request::is('impactadvertisor*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
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
                Manual Campaigns
              </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
					 @if(\App\CentralLogics\Helpers::module_permission_check('advertiser'))
					<a class="dropdown-item  {{Request::is('advertiser*')?'active':''}}"
                    href="{{Route('admin.advertiser.list')}}"> Advertisers</a>
					@endif
                  <a class="dropdown-item  {{Request::is('admin/coupon*')?'active':''}}"
                    href="{{ url('/coupon/list') }}"> Coupon</a>
                  <a class="dropdown-item  {{Request::is('ads*')?'active':''}}" href="{{Route('admin.ads.list')}}">
                    Ads</a>
                </div>
              </div>
            </div>
          </li>
          @endif
          {{-- End Manual Campagin --}}
          {{-- start Ads Network --}}
          @if(\App\CentralLogics\Helpers::module_permission_check('impact') ||
          \App\CentralLogics\Helpers::module_permission_check('cuelink') || \App\CentralLogics\Helpers::module_permission_check('admitad'))
          <li
            class="nav-item dropdown {{Request::is('impact*')?'active':''}} {{Request::is('impactadvertisor*')?'active':''}}  {{Request::is('cuelink*')?'active':''}} {{Request::is('admitad*')?'active':''}} {{Request::is('admitadadvertisor*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#settings" data-bs-toggle="dropdown" data-bs-auto-close="outside"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                <line x1="14" y1="7" x2="20" y2="7"></line>
                <line x1="17" y1="4" x2="17" y2="10"></line>
              </svg>
              </span>
              <span class="nav-link-title">Ads Network</span>
            </a>
            <div class="dropdown-menu" class="navbar-base" id="navbar-base">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">

                  <div class="dropend">
                    @if(\App\CentralLogics\Helpers::module_permission_check('impact'))
                    <a class="dropdown-item dropdown-toggle {{Request::is('impact*')?'active':''}}"  href="#sidebar-cards" data-bs-toggle="dropdown"
                      data-bs-auto-close="outside" role="button" aria-expanded="false"> Impact </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item  {{Request::is('impact/*')?'active':''}}"
                        href="{{route('admin.impact.impact-setup')}}"> Settings</a>
                      <a class="dropdown-item  {{Request::is('impactadvertiser*')?'active':''}}"
                        href="{{route('admin.impactadvertiser.add')}}"> Advertiser</a>
                      <a class="dropdown-item  {{Request::is('impactads*')?'active':''}}"
                        href="{{route('admin.impactads.list')}}"> Ads</a>
                    </div>
                    @endif
                  </div>

                  <div class="dropend">
                    @if(\App\CentralLogics\Helpers::module_permission_check('cuelink'))
                    <a class="dropdown-item dropdown-toggle {{Request::is('cuelinks*')?'active':''}}"  href="#sidebar-cards" data-bs-toggle="dropdown"
                      data-bs-auto-close="outside" role="button" aria-expanded="false"> Cuelinks </a>
                    <div class="dropdown-menu">
                      <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                          <a class="dropdown-item  {{Request::is('cuelinks/setup*')?'active':''}}"
                            href="{{route('admin.cuelinks.setup')}}"> Settings</a>
                          <a class="dropdown-item  {{Request::is('cuelinksadvertisers*')?'active':''}}"
                            href="{{route('admin.cuelinksadvertisers.list')}}"> Advertisers</a>
                          <a class="dropdown-item  {{Request::is('cuelinkscampaigns/')?'active':''}}"
                            href="{{route('admin.cuelinkscampaigns.list')}}"> Campaigns</a>
                          <a class="dropdown-item  {{Request::is('cuelinksoffers*')?'active':''}}"
                            href="{{route('admin.cuelinksoffers.list')}}"> Offers</a>
                           <a class="dropdown-item  {{Request::is('coupons/cuelink*')?'active':''}}"
                            href="{{route('admin.coupons.coupan')}}"> Coupon</a>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>

                  <div class="dropend">
                    @if(\App\CentralLogics\Helpers::module_permission_check('admitad'))
                    <a class="dropdown-item dropdown-toggle {{Request::is('admitad*')?'active':''}}" href="#sidebar-cards" data-bs-toggle="dropdown"
                      data-bs-auto-close="outside" role="button" aria-expanded="false"> Admitad </a>
                    <div class="dropdown-menu">
                      <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                          <a class="dropdown-item  {{Request::is('admitad/setup*')?'active':''}}"
                            href="{{route('admin.admitad.setup')}}"> Settings</a>
                          <a class="dropdown-item  {{Request::is('admitadadvertisers*')?'active':''}}"
                            href="{{route('admin.admitadadvertisers.list')}}"> Advertisers</a>
                          <a class="dropdown-item  {{Request::is('admitadcampaigns*')?'active':''}}"
                            href="{{route('admin.admitadcampaigns.list')}}"> Campaigns</a>
							 <a class="dropdown-item  {{Request::is('coupons/admitad*')?'active':''}}"
                            href="{{route('admin.coupons.admi_coupan')}}"> Coupon</a>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>

                </div>                
              </div>
            </div>
          </li>
          @endif
          {{-- End Ads Network --}}



          {{-- @if(\App\CentralLogics\Helpers::module_permission_check('impact'))
          <li
            class="nav-item dropdown {{Request::is('impact*')?'active':''}} {{Request::is('impactadvertisor*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
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
                  <a class="dropdown-item  {{Request::is('impact-setup*')?'active':''}}"
                    href="{{route('admin.impact.impact-setup')}}"> Settings</a>
                  <a class="dropdown-item  {{Request::is('impactadvertisor*')?'active':''}}"
                    href="{{route('admin.impactadvertiser.add')}}"> Advertiser</a>
                  <a class="dropdown-item  {{Request::is('impactads*')?'active':''}}"
                    href="{{route('admin.impactads.list')}}"> Ads</a>
                </div>
              </div>
            </div>
          </li>
          @endif

          @if(\App\CentralLogics\Helpers::module_permission_check('cuelink'))
          <li
            class="nav-item dropdown {{Request::is('cuelink*')?'active':''}} {{Request::is('impactadvertisor*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
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
                  <a class="dropdown-item  {{Request::is('cuelinks/setup*')?'active':''}}"
                    href="{{route('admin.cuelinks.setup')}}">
                    Settings
                  </a>
                  <a class="dropdown-item  {{Request::is('cuelinksadvertisers*')?'active':''}}"
                    href="{{route('admin.cuelinksadvertisers.list')}}">
                    Advertisers
                  </a>
                  <a class="dropdown-item  {{Request::is('cuelinkscampaigns*')?'active':''}}"
                    href="{{route('admin.cuelinkscampaigns.list')}}">
                    Campaigns
                  </a>
                  <a class="dropdown-item  {{Request::is('cuelinksoffers*')?'active':''}}"
                    href="{{route('admin.cuelinksoffers.list')}}">
                    Offers
                  </a>

                </div>
              </div>
            </div>
          </li>
          @endif --}}


          {{-- @if(\App\CentralLogics\Helpers::module_permission_check('admitad'))
          <li
            class="nav-item dropdown {{Request::is('admitad*')?'active':''}} {{Request::is('admitadadvertisor*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="24" height="24"
                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
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
                  <a class="dropdown-item  {{Request::is('admitad/setup*')?'active':''}}"
                    href="{{route('admin.admitad.setup')}}"> Settings</a>
                  <a class="dropdown-item  {{Request::is('admitadadvertisers*')?'active':''}}"
                    href="{{route('admin.admitadadvertisers.list')}}"> Advertisers</a>
                  <a class="dropdown-item  {{Request::is('admitadcampaigns*')?'active':''}}"
                    href="{{route('admin.admitadcampaigns.list')}}"> Campaigns</a>
                </div>
              </div>
            </div>
          </li>
          @endif --}}

          <li class="nav-item  {{Request::is('product*')?'active':''}}">
            <a class="nav-link" href="{{route('admin.product.list')}}">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <rect x="2" y="13" width="8" height="8" rx="2"></rect>
                  <path d="M6 13v3"></path>
                  <rect x="8" y="3" width="8" height="8" rx="2"></rect>
                  <path d="M12 3v3"></path>
                  <rect x="14" y="13" width="8" height="8" rx="2"></rect>
                  <path d="M18 13v3"></path>
                </svg>
              </span>
              <span class="nav-link-title">Products</span>
            </a>
          </li>
          @if(\App\CentralLogics\Helpers::module_permission_check('settings') ||
          \App\CentralLogics\Helpers::module_permission_check('referral') ||
          \App\CentralLogics\Helpers::module_permission_check('currency') ||
          \App\CentralLogics\Helpers::module_permission_check('notifications') ||
          \App\CentralLogics\Helpers::module_permission_check('team') ||
          \App\CentralLogics\Helpers::module_permission_check('role') ||
          \App\CentralLogics\Helpers::module_permission_check('withdrawal') ||
          \App\CentralLogics\Helpers::module_permission_check('clicks') ||
          \App\CentralLogics\Helpers::module_permission_check('orders') ||
          \App\CentralLogics\Helpers::module_permission_check('dispute') ||
          \App\CentralLogics\Helpers::module_permission_check('trending'))
          <li
            class="nav-item dropdown  {{Request::is('admin/info-settings/info-setup*')?'active':''}}  {{Request::is('admin/banner*')?'active':''}} {{Request::is('admin/homeadv*')?'active':''}} {{Request::is('admin/allin*')?'active':''}}{{Request::is('admin/faq*')?'active':''}}{{Request::is('admin/coupon*')?'active':''}}">
            <a class="nav-link dropdown-toggle" href="#settings" data-bs-toggle="dropdown" data-bs-auto-close="outside"
              role="button" aria-expanded="false">
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                  stroke-linecap="round" stroke-linejoin="round">
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
              <span class="nav-link-title">Others</span>
            </a>
            <div class="dropdown-menu" class="navbar-base" id="navbar-base">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  @if(\App\CentralLogics\Helpers::module_permission_check('settings'))
                  <a class="dropdown-item {{Request::is('admin/info-settings/info-setup')?'active':''}}"
                    href="{{Route('admin.info-settings.info-setup')}}">Master Settings</a>
                  @endif

                  @if(\App\CentralLogics\Helpers::module_permission_check('referral'))
                  <a class="dropdown-item {{Request::is('admin/referral-settings/referral-setup')?'active':''}}"
                    href="{{Route('admin.referral-settings.referral-setup')}}">Referral Settings</a>
                  @endif

                  @if(\App\CentralLogics\Helpers::module_permission_check('currency'))
                  <a class="dropdown-item {{Request::is('admin/info-settings/currency-setup')?'active':''}}"
                    href="{{Route('admin.info-settings.currency-setup')}}">Currency Settings</a>
                  @endif
                  @if(\App\CentralLogics\Helpers::module_permission_check('notifications'))
                  <a class="dropdown-item {{Request::is('admin/fcm/index')?'active':''}}"
                    href="{{Route('admin.fcm.index')}}">Firebase Settings</a>
                  @endif
                  @if(\App\CentralLogics\Helpers::module_permission_check('team') ||
                  \App\CentralLogics\Helpers::module_permission_check('role'))
                  <div class="dropend">
                    <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown"
                      data-bs-auto-close="outside" role="button" aria-expanded="false"> Team </a>
                    <div class="dropdown-menu">
                      @if(\App\CentralLogics\Helpers::module_permission_check('role'))
                      <a class="dropdown-item  {{Request::is('role*')?'active':''}}"
                        href="{{route('admin.role.create')}}">Team Roles</a>
                      @endif
                      @if(\App\CentralLogics\Helpers::module_permission_check('team'))
                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle {{Request::is('team*')?'active':''}}"
                          href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                          aria-expanded="false"> Teams</a>
                        <div class="dropdown-menu">
                          <a href="{{route('admin.team.list')}}"
                            class="dropdown-item {{Request::is('team/list*')?'active':''}}">Team Member List</a>
                          <a href="{{route('admin.team.add-new')}}"
                            class="dropdown-item {{Request::is('team/add*')?'active':''}}">Add Team Member</a>
                        </div>
                      </div>
                      @endif
                    </div>
                    @endif
                 
                    @if(\App\CentralLogics\Helpers::module_permission_check('ad_network') ||
                    \App\CentralLogics\Helpers::module_permission_check('admob')||
                    \App\CentralLogics\Helpers::module_permission_check('fbads'))
                    <div class="dropend">
                      <a class="dropdown-item dropdown-toggle {{Request::is('ad_network*')?'active':''}} {{Request::is('admob*')?'active':''}} {{Request::is('fbads*')?'active':''}}"
                        href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                        aria-expanded="false">Admob and Facebook Ads</a>
                      <div class="dropdown-menu">
                        @if(\App\CentralLogics\Helpers::module_permission_check('ad_network'))
                        <a class="dropdown-item  {{Request::is('ad_network*')?'active':''}}"
                          href="{{route('admin.ad_network.settings')}}"> Settings </a>
                        @endif
                        @if(\App\CentralLogics\Helpers::module_permission_check('admob'))
                        <a class="dropdown-item  {{Request::is('admob*')?'active':''}}"
                          href="{{route('admin.admob.setup')}}">Admob </a>
                        @endif
                        @if(\App\CentralLogics\Helpers::module_permission_check('fbads'))
                        <a class="dropdown-item  {{Request::is('fbads*')?'active':''}}"
                          href="{{route('admin.fbads.setup')}}"> Facebook Ads </a>
                        @endif

                      </div>
                    </div>
                    @endif
                  </div>
                 <div class="dropend">

                    @if(\App\CentralLogics\Helpers::module_permission_check('withdrawal'))
                    <a class="dropdown-item {{Request::is('admin/records/withdraw_requests*')?'active':''}}"
                      href="{{Route('admin.records.withdraw_requests')}}">Withdrawal Requests</a>
                    @endif
                    @if(\App\CentralLogics\Helpers::module_permission_check('clicks'))
                    <a class="dropdown-item {{Request::is('admin/records/clicks*')?'active':''}}"
                      href="{{Route('admin.records.clicks')}}">Click Management</a>
                    @endif
                    @if(\App\CentralLogics\Helpers::module_permission_check('orders'))
                    <a class="dropdown-item {{Request::is('admin/records/orders*')?'active':''}}"
                      href="{{Route('admin.records.orders')}}">Order management</a>
                    @endif
                    @if(\App\CentralLogics\Helpers::module_permission_check('dispute'))
                    <a class="dropdown-item {{Request::is('admin/records/complaint*')?'active':''}}"
                      href="{{Route('admin.records.complaint')}}">Dispute Management</a>
                    @endif
                    @if(\App\CentralLogics\Helpers::module_permission_check('trending'))
                    <a class="dropdown-item {{Request::is('admin/trending*')?'active':''}}"
                      href="{{Route('admin.trending.index')}}">Trending Search</a>
                    @endif

                  </div>
                </div>
              </div>
              </div>
          </li>
          @endif


        </ul>

      </div>
    </div>
  </div>
</div>