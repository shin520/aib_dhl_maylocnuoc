<header id="header">
  <div class="container">
    <div class="banner-top">
      <div class="row">
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <div class="logo">
              <a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}">
                <img src="/storage/uploads/{{ $setting->logoindex }}" alt="{{ $setting->nameindex }}" title="{{ $setting->nameindex }}">
              </a>
          </div>
        </div>
        <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
          <div class="banner">
            <a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}"><img src="/storage/uploads/{{ $setting->header }}" alt="{{ $setting->nameindex }}" title="{{ $setting->nameindex }}"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!--====================  header area ====================-->
    <div class="header-area bg-white bg-custom {{-- header-sticky only-mobile-sticky --}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header position-relative">
                        <!-- brand logo -->
                        <!-- <div class="header__logo">
                            <a href="index.html">
                                <img src="assets/images/logo/logo-dark.png" class="img-fluid" alt="">
                            </a>
                        </div> -->

                        <div class="header-right flexible-image-slider-wrap">

                            <div class="header-right-inner" id="hidden-icon-wrapper">
                                <!-- Header Search Form -->
                                <div class="header-search-form d-md-none d-block">
                                    <form action="#" class="search-form-top">
                                        <input class="search-field" type="text" placeholder="Search…">
                                        <button class="search-submit">
                                            <i class="search-btn-icon fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>

                    

                                <!-- Header Social Networks -->
                                <!-- <div class="header-social-networks style-icons">
                                    <div class="inner">
                                        <a class=" social-link hint--bounce hint--bottom-left" aria-label="Twitter" href="https://twitter.com" data-hover="Twitter" target="_blank">
                                            <i class="social-icon fab fa-twitter"></i>
                                        </a>
                                        <a class=" social-link hint--bounce hint--bottom-left" aria-label="Facebook" href="https://facebook.com" data-hover="Facebook" target="_blank">
                                            <i class="social-icon fab fa-facebook-f"></i>
                                        </a>
                                        <a class=" social-link hint--bounce hint--bottom-left" aria-label="Instagram" href="https://instagram.com" data-hover="Instagram" target="_blank">
                                            <i class="social-icon fab fa-instagram"></i>
                                        </a>
                                        <a class=" social-link hint--bounce hint--bottom-left" aria-label="Linkedin" href="https://linkedin.com" data-hover="Linkedin" target="_blank">
                                            <i class="social-icon fab fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div> -->

                            </div>
                            <!-- mobile menu -->
                            <div class="mobile-navigation-icon d-block d-xl-none" id="mobile-menu-trigger">
                                <i></i>
                            </div>
                            <!-- hidden icons menu -->
                            {{-- <div class="hidden-icons-menu d-block d-md-none" id="hidden-icon-trigger">
                                <a href="javascript:void(0)">
                                    <i class="far fa-ellipsis-h-alt"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom-wrap border-top d-md-block d-none header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-bottom-inner">
                            <div class="header-bottom-left-wrap">
                                <!-- navigation menu -->
                                <div class="header__navigation d-none d-xl-block">
                                    <nav class="navigation-menu">
                                        <ul style="list-style-type: none; position: relative;">
                                            <li class="{{-- has-children has-children--multilevel-submenu --}}">
                                                <a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><span>{{ __('home') }}</span></a>
                                                {{-- <ul class="submenu">
                                                    <li><a href="index-infotechno.html"><span>Infotechno</span></a></li>
                                                    <li><a href="index-processing.html"><span>Processing</span></a></li>
                                                    <li><a href="index-appointment.html"><span>Appointment</span></a></li>
                                                    <li><a href="index-services.html"><span>Services</span></a></li>
                                                    <li><a href="index-resolutions.html"><span>Resolutions</span></a></li>
                                                    <li><a href="index-cybersecurity.html"><span>Cybersecurity</span></a></li>
                                                </ul> --}}
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.about.index') }}" title="{{ $abouts->name }}"><span>{{ __('about') }}</span></a>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>{{ __('domain') }}</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    @foreach ($domains as $k => $domain)
                                                    @if($domain->hide_show == 1 and $domain->status == 'Published' and $domains = Domain::orderBy('stt', 'asc'))
                                                    <li><a href="{{ route('frontend.home.index') }}/ten-mien/{{ $domain->slug.'.html' }}" title="{{ $domain->domain }}"><span>{{ $domain->name }}</span></a></li>
                                                    @endif
                                                    @endforeach

                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>{{ __('hosting') }}</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    @foreach ($categories as $k => $category)
                                                    <li><a href="{{ route('frontend.home.index') }}/hosting/{{ $category->slug.'.html' }}" title="{{ $domain->category }}"><span>{{ $category->name }}</span></a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>{{ __('email') }}</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    @foreach ($webmails as $k => $webmail)
                                                                  @if($webmail->hide_show == 1 and $webmail->status == 'Published')
                                                    <li><a href="{{ route('frontend.home.index') }}/email-server/{{ $webmail->slug.'.html' }}" title="{{ $domain->webmail }}"><span>{{ $webmail->name }}</span></a></li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>Company</span></a>
                                                <ul class="submenu">
                                                    <li class="has-children">
                                                        <a href="about-us-01.html"><span>About us</span></a>
                                                        <ul class="submenu">
                                                            <li><a href="about-us-01.html"><span>About us 01</span></a></li>
                                                            <li><a href="about-us-02.html"><span>About us 02</span></a></li>
                                                            <li class="has-children">
                                                                <a href="#"><span>Submenu Level Two</span></a>
                                                                <ul class="submenu">
                                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="contact-us.html"><span>Contact us</span></a></li>
                                                    <li><a href="leadership.html"><span>Leadership</span></a></li>
                                                    <li><a href="why-choose-us.html"><span>Why choose us</span></a></li>
                                                    <li><a href="our-history.html"><span>Our history</span></a></li>
                                                    <li><a href="faqs.html"><span>FAQs</span></a></li>
                                                    <li><a href="careers.html"><span>Careers</span></a></li>
                                                    <li><a href="pricing-plans.html"><span>Pricing plans</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>IT solutions</span></a>
                                                <ul class="submenu">
                                                    <li><a href="it-services.html"><span>IT Services</span></a></li>
                                                    <li><a href="managed-it-services.html"><span>Managed IT Services</span></a></li>
                                                    <li><a href="industries.html"><span>Industries</span></a></li>
                                                    <li><a href="business-solution.html"><span>Business solution</span></a></li>
                                                    <li><a href="it-services-details.html"><span>IT Services Details</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="has-children">
                                                <a href="#"><span>Elements</span></a>
                                                <!-- mega menu -->
                                                <ul class="megamenu megamenu--mega">
                                                    <li>
                                                        <h2 class="page-list-title">ELEMENT GROUP 01</h2>
                                                        <ul>
                                                            <li><a href="element-accordion.html"><span>Accordions & Toggles</span></a></li>
                                                            <li><a href="element-box-icon.html"><span>Box Icon</span></a></li>
                                                            <li><a href="element-box-image.html"><span>Box Image</span></a></li>
                                                            <li><a href="element-box-large-image.html"><span>Box Large Image</span></a></li>
                                                            <li><a href="element-buttons.html"><span>Buttons</span></a></li>
                                                            <li><a href="element-cta.html"><span>Call to action</span></a></li>
                                                            <li><a href="element-client-logo.html"><span>Client Logo</span></a></li>
                                                            <li><a href="element-countdown.html"><span>Countdown</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h2 class="page-list-title">ELEMENT GROUP 02</h2>
                                                        <ul>
                                                            <li><a href="element-counters.html"><span>Counters</span></a></li>
                                                            <li><a href="element-dividers.html"><span>Dividers</span></a></li>
                                                            <li><a href="element-flexible-image-slider.html"><span>Flexible image slider</span></a></li>
                                                            <li><a href="element-google-map.html"><span>Google Map</span></a></li>
                                                            <li><a href="element-gradation.html"><span>Gradation</span></a></li>
                                                            <li><a href="element-instagram.html"><span>Instagram</span></a></li>
                                                            <li><a href="element-lists.html"><span>Lists</span></a></li>
                                                            <li><a href="element-message-box.html"><span>Message box</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h2 class="page-list-title">ELEMENT GROUP 03</h2>
                                                        <ul>
                                                            <li><a href="element-popup-video.html"><span>Popup Video</span></a></li>
                                                            <li><a href="element-pricing-box.html"><span>Pricing Box</span></a></li>
                                                            <li><a href="element-progress-bar.html"><span>Progress Bar</span></a></li>
                                                            <li><a href="element-progress-circle.html"><span>Progress Circle</span></a></li>
                                                            <li><a href="element-rows-columns.html"><span>Rows & Columns</span></a></li>
                                                            <li><a href="element-social-networks.html"><span>Social Networks</span></a></li>
                                                            <li><a href="element-tabs.html"><span>Tabs</span></a></li>
                                                            <li><a href="element-team-member.html"><span>Team member</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h2 class="page-list-title">ELEMENT GROUP 04</h2>
                                                        <ul>
                                                            <li><a href="element-testimonials.html"><span>Testimonials</span></a></li>
                                                            <li><a href="element-timeline.html"><span>Timeline</span></a></li>
                                                            <li><a href="element-carousel-sliders.html"><span>Carousel Sliders</span></a></li>
                                                            <li><a href="element-typed-text.html"><span>Typed Text</span></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="#"><span>Case Studies</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    <li><a href="case-studies.html"><span>Case Studies 01</span></a></li>
                                                    <li><a href="case-studies-02.html"><span>Case Studies 02</span></a></li>
                                                    <li><a href="single-smart-vision.html"><span>Single Layout</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="blog-list-large-image.html"><span>Blog</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    <li><a href="blog-list-large-image.html"><span>List Large Image</span></a></li>
                                                    <li><a href="blog-list-left-large-image.html"><span>Left Large Image</span></a></li>
                                                    <li><a href="blog-grid-classic.html"><span>Grid Classic</span></a></li>
                                                    <li><a href="blog-grid-masonry.html"><span>Grid Masonry</span></a></li>
                                                    <li class="has-children">
                                                        <a href="blog-post-layout-one.html"><span>Single Layouts</span></a>
                                                        <ul class="submenu">
                                                            <li><a href="blog-post-layout-one.html"><span>Left Sidebar</span></a></li>
                                                            <li><a href="blog-post-right-sidebar.html"><span>Right Sidebar</span></a></li>
                                                            <li><a href="blog-post-no-sidebar.html"><span>No Sidebar</span></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <div class="lang">
                                              <a href="{{ route('frontend.locale.index',['vi']) }}" class="lang-vi vi" title="Vietnamese"></a>
                                              <a href="{{ route('frontend.locale.index',['en']) }}" class="lang-en en" title="English"></a>
                                            </div>
                                        </ul>

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--====================  End of header area  ====================-->

    <div class="site-wrapper-reveal">
  
    
        <!--====================  mobile menu overlay ====================-->
        <div class="mobile-menu-overlay" id="mobile-menu-overlay">
            <div class="mobile-menu-overlay__inner">
                <div class="mobile-menu-overlay__header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-8">
                                <!-- logo -->
                                {{-- <div class="logo">
                                    <a href="index.html">
                                        <img src="assets/images/logo/logo-dark.png" class="img-fluid" alt="">
                                    </a>
                                </div> --}}
                                {{-- <div class="logo">
                                    <a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}">
                                      <img src="/storage/uploads/{{ $setting->logoindex }}" class="img-fluid" alt="{{ $setting->nameindex }}" title="{{ $setting->nameindex }}">
                                    </a>
                                </div> --}}
                            </div>
                            <div class="col-md-6 col-4">
                                <!-- mobile menu content -->
                                <div class="mobile-menu-content text-right">
                                    <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-overlay__body">
                    <nav class="offcanvas-navigation">
                        <ul class="ul-cus">
                            <li class="has-children">
                                <a href="index.html">{{ __('home') }}</a>
                                {{-- <ul class="sub-menu">
                                    <li><a href="index-infotechno.html"><span>Infotechno</span></a></li>
                                    <li><a href="index-processing.html"><span>Processing</span></a></li>
                                    <li><a href="index-appointment.html"><span>Appointment</span></a></li>
                                    <li><a href="index-services.html"><span>Services</span></a></li>
                                    <li><a href="index-resolutions.html"><span>Resolutions</span></a></li>
                                    <li><a href="index-cybersecurity.html"><span>cybersecurity</span></a></li>
                                </ul> --}}
                            </li>
                            <li class="has-children">
                                <a href="#">Company</a>
                                <ul class="sub-menu">
                                    <li class="has-children">
                                        <a href="about-us-01.html"><span>About us</span></a>
                                        <ul class="sub-menu">
                                            <li><a href="about-us-01.html"><span>About us 01</span></a></li>
                                            <li><a href="about-us-02.html"><span>About us 02</span></a></li>
                                            <li class="has-children">
                                                <a href="#"><span>Submenu Level Two</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                    <li><a href="#"><span>Submenu Level Three</span></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact-us.html"><span>Contact us</span></a></li>
                                    <li><a href="leadership.html"><span>Leadership</span></a></li>
                                    <li><a href="why-choose-us.html"><span>Why choose us</span></a></li>
                                    <li><a href="our-history.html"><span>Our history</span></a></li>
                                    <li><a href="faqs.html"><span>FAQs</span></a></li>
                                    <li><a href="careers.html"><span>Careers</span></a></li>
                                    <li><a href="pricing-plans.html"><span>Pricing plans</span></a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">IT solutions</a>
                                <ul class="sub-menu">
                                    <li><a href="it-services.html"><span>IT Services</span></a></li>
                                    <li><a href="managed-it-services.html"><span>Managed IT Services</span></a></li>
                                    <li><a href="industries.html"><span>Industries</span></a></li>
                                    <li><a href="business-solution.html"><span>Business solution</span></a></li>
                                    <li><a href="it-services-details.html"><span>IT Services Details</span></a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">Elements</a>
                                <ul class="sub-menu">
                                    <li class="has-children">
                                        <a href="#">Element Group 01</a>
                                        <ul class="sub-menu">
                                            <li><a href="element-accordion.html"><span>Accordions & Toggles</span></a></li>
                                            <li><a href="element-box-icon.html"><span>Box Icon</span></a></li>
                                            <li><a href="element-box-image.html"><span>Box Image</span></a></li>
                                            <li><a href="element-box-large-image.html"><span>Box Large Image</span></a></li>
                                            <li><a href="element-buttons.html"><span>Buttons</span></a></li>
                                            <li><a href="element-cta.html"><span>Call to action</span></a></li>
                                            <li><a href="element-client-logo.html"><span>Client Logo</span></a></li>
                                            <li><a href="element-countdown.html"><span>Countdown</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#">Element Group 02</a>
                                        <ul class="sub-menu">
                                            <li><a href="element-counters.html"><span>Counters</span></a></li>
                                            <li><a href="element-dividers.html"><span>Dividers</span></a></li>
                                            <li><a href="element-flexible-image-slider.html"><span>Flexible image slider</span></a></li>
                                            <li><a href="element-google-map.html"><span>Google Map</span></a></li>
                                            <li><a href="element-gradation.html"><span>Gradation</span></a></li>
                                            <li><a href="element-instagram.html"><span>Instagram</span></a></li>
                                            <li><a href="element-lists.html"><span>Lists</span></a></li>
                                            <li><a href="element-message-box.html"><span>Message box</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#">Element Group 03</a>
                                        <ul class="sub-menu">
                                            <li><a href="element-popup-video.html"><span>Popup Video</span></a></li>
                                            <li><a href="element-pricing-box.html"><span>Pricing Box</span></a></li>
                                            <li><a href="element-progress-bar.html"><span>Progress Bar</span></a></li>
                                            <li><a href="element-progress-circle.html"><span>Progress Circle</span></a></li>
                                            <li><a href="element-rows-columns.html"><span>Rows & Columns</span></a></li>
                                            <li><a href="element-social-networks.html"><span>Social Networks</span></a></li>
                                            <li><a href="element-tabs.html"><span>Tabs</span></a></li>
                                            <li><a href="element-team-member.html"><span>Team member</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="has-children">
                                        <a href="#">Element Group 04</a>
                                        <ul class="sub-menu">
                                            <li><a href="element-testimonials.html"><span>Testimonials</span></a></li>
                                            <li><a href="element-timeline.html"><span>Timeline</span></a></li>
                                            <li><a href="element-carousel-sliders.html"><span>Carousel Sliders</span></a></li>
                                            <li><a href="element-typed-text.html"><span>Typed Text</span></a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="javascript:void(0)">Case Studies</a>
                                <ul class="sub-menu">
                                    <li><a href="case-studies.html"><span>Case Studies 01</span></a></li>
                                    <li><a href="case-studies-02.html"><span>Case Studies 02</span></a></li>
                                    <li><a href="single-smart-vision.html"><span>Single Layout</span></a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="javascript:void(0)">Blogs</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-list-large-image.html"><span>List Large Image</span></a></li>
                                    <li><a href="blog-list-left-large-image.html"><span>Left Large Image</span></a></li>
                                    <li><a href="blog-grid-classic.html"><span>Grid Classic</span></a></li>
                                    <li><a href="blog-grid-masonry.html"><span>Grid Masonry</span></a></li>
                                    <li class="has-children">
                                        <a href="blog-post-layout-one.html"><span>Single Layouts</span></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-post-layout-one.html"><span>Left Sidebar</span></a></li>
                                            <li><a href="blog-post-right-sidebar.html"><span>Right Sidebar</span></a></li>
                                            <li><a href="blog-post-no-sidebar.html"><span>No Sidebar</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--====================  End of mobile menu overlay  ====================-->