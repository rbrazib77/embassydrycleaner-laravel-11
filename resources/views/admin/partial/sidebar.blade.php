 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <div class="logo-box">
                 <a href="index.html" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                     </span>
                 </a>
                 <a href="index.html" class="logo logo-dark">
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
                     <a href="{{route('dashboard')}}" class="tp-link">
                         <i data-feather="home"></i>
                         <span> Dashboard </span>
                     </a>
                 </li>
                 <li class="menu-title">Pages</li>

                 <li>
                     <a href="#sidebarAuth" data-bs-toggle="collapse">
                         <i data-feather="users"></i>
                         <span> Authentication </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAuth">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="auth-login.html" class="tp-link">Log In</a>
                             </li>
                             <li>
                                 <a href="auth-register.html" class="tp-link">Register</a>
                             </li>
                             <li>
                                 <a href="auth-recoverpw.html" class="tp-link">Recover Password</a>
                             </li>
                             <li>
                                 <a href="auth-lock-screen.html" class="tp-link">Lock Screen</a>
                             </li>
                             <li>
                                 <a href="auth-confirm-mail.html" class="tp-link">Confirm Mail</a>
                             </li>
                             <li>
                                 <a href="email-verification.html" class="tp-link">Email Verification</a>
                             </li>
                             <li>
                                 <a href="auth-logout.html" class="tp-link">Logout</a>
                             </li>
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
