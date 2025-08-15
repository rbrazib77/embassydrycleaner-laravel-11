 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <div class="logo-box">
                 <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                     </span>
                 </a>
                 <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                     </span>
                 </a>
             </div>

             <ul id="side-menu">

                 <li class="menu-title">Menu</li>
                 <li>
                     <a href="{{ route('admin.dashboard') }}" class="tp-link">
                         <i data-feather="home"></i>
                         <span> Dashboard </span>
                     </a>
                 </li>
                 <li class="menu-title">Pages</li>
                 <li>
                     <a href="{{ route('admin.user.list') }}" class="tp-link">
                         <i data-feather="users"></i>
                         <span> User List </span>
                     </a>
                 </li>

                   <li>
                     <a href="{{route('admin.user-activity.index')}}" class="tp-link">
                         <i data-feather="users"></i>
                         <span>Website Visitor List</span>
                     </a>
                 </li>

                 <li>
                     <a href="#sidebarAuth" data-bs-toggle="collapse">
                         <i data-feather="users"></i>
                         <span> Home Page </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAuth">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('admin.banner.index') }}" class="tp-link">Banner Section</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.service.index')}}" class="tp-link">Our Service Section</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.how.it.works.index')}}" class="tp-link">How It Works Section</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.passionate.about.laundry.create')}}" class="tp-link">Passionate About</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.faq.section.index')}}" class="tp-link">Faq Section</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.partnership.create')}}" class="tp-link">Partnership Page</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.career.create')}}" class="tp-link">Career Page</a>
                             </li>
                         </ul>
                     </div>
                 </li>

                  <li>
                     <a href="#sidebarAdvancedUI" data-bs-toggle="collapse">
                         <i data-feather="cpu"></i>
                         <span> Setting </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAdvancedUI">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{route('admin.website.index')}}" class="tp-link">Website Setting</a>
                             </li>
                             <li>
                                 <a href="{{route('admin.social.media.link.index')}}" class="tp-link">Socile Media</a>
                             </li>
                             {{-- <li>
                                 <a href="extended-offcanvas.html" class="tp-link">Offcanvas</a>
                             </li>
                             <li>
                                 <a href="extended-range-slider.html" class="tp-link">Range Slider</a>
                             </li> --}}
                         </ul>
                     </div>
                 </li>


                 <li>
                     <a href="calendar.html" class="tp-link">
                         <i data-feather="calendar"></i>
                         <span> Calendar </span>
                     </a>
                 </li>

                 <li class="menu-title mt-2">General</li>

                 <li>
                     <a href="#sidebarBaseui" data-bs-toggle="collapse">
                         <i data-feather="package"></i>
                         <span> Components </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarBaseui">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="ui-accordions.html" class="tp-link">Accordions</a>
                             </li>
                             <li>
                                 <a href="ui-alerts.html" class="tp-link">Alerts</a>
                             </li>
                             <li>
                                 <a href="ui-badges.html" class="tp-link">Badges</a>
                             </li>
                         </ul>
                     </div>
                 </li>

                 <li>
                     <a href="widgets.html" class="tp-link">
                         <i data-feather="aperture"></i>
                         <span> Widgets </span>
                     </a>
                 </li>

                 <li>
                     <a href="#sidebarAdvancedUI" data-bs-toggle="collapse">
                         <i data-feather="cpu"></i>
                         <span> Extended UI </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAdvancedUI">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="extended-carousel.html" class="tp-link">Carousel</a>
                             </li>
                             <li>
                                 <a href="extended-notifications.html" class="tp-link">Notifications</a>
                             </li>
                             <li>
                                 <a href="extended-offcanvas.html" class="tp-link">Offcanvas</a>
                             </li>
                             <li>
                                 <a href="extended-range-slider.html" class="tp-link">Range Slider</a>
                             </li>
                         </ul>
                     </div>
                 </li>

                 <li>
                     <a href="#sidebarIcons" data-bs-toggle="collapse">
                         <i data-feather="award"></i>
                         <span> Icons </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarIcons">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="icons-feather.html" class="tp-link">Feather Icons</a>
                             </li>
                             <li>
                                 <a href="icons-mdi.html" class="tp-link">Material Design Icons</a>
                             </li>
                         </ul>
                     </div>
                 </li>
             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
 </div>
