<header id="header" class="header">
  <div class="container">
    <div class="banner-top">
      <div class="row">
        <div class="col-md-6 text-center">
            <div class="hotline" style="font-size: 20px;text-shadow: 1px 1px #000;">
                <span style="color: #fff">Hotline:</span><span style="color: orange"> {{ $setting->hotline_1 }}</span>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="social-follow-us">
              <div class="social-icon-group" style="display: inline;">
                @foreach($sliders as $slider)
                @if($slider->type == 'social')
                <a href="{{ $slider->url }}" class="social" target="_blank" rel="nofollow">
                  {!! $slider->icon !!}
                </a>
                @endif
                @endforeach
              </div>
            </div>
        </div>
        {{-- <div class="col-md-2">
            <a class="btn btn-danger btn-custom btn-order" href="{{ route('order.view') }}" title="Giỏ hàng" style="float: right"><i class="ti ti-shopping-cart-full" style="color: #ffffff; font-size: 16px;"><span style="font-family: 'RobotoCondensed-Regular',sans-serif;"> {{ $order->total_quantity }} Món</span></i></a>
        </div> --}}
      </div>
      <div class="row">
          <div class="col-12">
              <div class="logo-mobile" style="position: relative; width: 100px;margin: 0 auto;">
                  <a style="position: absolute;top: 0;z-index: 9;" href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}">
                    <img class="mx-auto d-block" src="/storage/uploads/{{ $setting->logoindex }}" alt="{{ $setting->nameindex }}" title="{{ $setting->nameindex }}" width="100">
                  </a>
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
        <div class="header-bottom-wrap {{-- border-top --}} d-md-block d-none {{-- header-sticky --}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-bottom-inner">
                            <div class="header-bottom-left-wrap d-flex justify-content-center">
                                <!-- navigation menu -->
                                <div class="header__navigation d-none d-xl-block">
                                    <nav class="navigation-menu">
                                        <ul style="list-style-type: none; position: relative;">
                                            <li>
                                                <a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><span>{{ __('home') }}</span></a>
                                            </li>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="{{ route('frontend.cat') }}"><span>{{ __('product') }}</span></a>
                                                @php
                                                    recursive ($pro_cats)
                                                @endphp

                                            </li>
                                            @if($abouts->hide_show == 1)
                                            <li>
                                                <a href="{{ route('frontend.about.index') }}" title="{{ $abouts->name }}"><span>{{ __('about') }}</span></a>
                                            </li>
                                            @endif
                                            <ul style="position: relative; width: 150px">
                                                @php
                                                    $img = $setting->logoindex
                                                @endphp
                                                <a style="position: absolute;top: -60px;z-index: 9;" href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}">
                                                  <img src="{{ imageUrl('/storage/uploads/'.$img,'150','150','100','1') }}" alt="{{ $setting->nameindex }}" title="{{ $setting->nameindex }}" width="150">
                                                </a>
                                            </ul>
                                            <li class="has-children has-children--multilevel-submenu">
                                                <a href="{{ route('frontend.news') }}"><span>{{ __('new') }}</span></a>
                                                <!-- multilevel submenu -->
                                                <ul class="submenu">
                                                    @foreach ($newcategories as $k => $newcategory)
                                                    <li><a href="{{ route('frontend.home.index') }}/tin-tuc/{{ $newcategory->slug.'.html' }}" title="{{ $newcategory->name }}"><span>{{ $newcategory->name }}</span></a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="{{ route('frontend.feedback.index') }}" title="Góp ý"><span>GÓP Ý</span></a>
                                            </li>
                                            @if($contacts->hide_show == 1)
                                            <li>
                                                <a href="{{ route('frontend.contact.index') }}" title="{{ $contacts->title }}"><span>{{ __('contact') }}</span></a>
                                            </li>
                                            @endif
                                            {{-- <div class="lang">
                                              <a href="{{ route('frontend.locale.index',['vi']) }}" class="lang-vi vi" title="Vietnamese"></a>
                                              <a href="{{ route('frontend.locale.index',['en']) }}" class="lang-en en" title="English"></a>
                                            </div> --}}
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
                            <div class="col-md-12 col-12">
                                <!-- mobile menu content -->
                                <div class="mobile-menu-content text-left">
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
                                <a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}">{{ __('home') }}</a>
                            </li>
                            @if($abouts->hide_show == 1)
                            <li>
                                <a href="{{ route('frontend.about.index') }}" title="{{ $abouts->name }}"><span>{{ __('about') }}</span></a>
                            </li>
                            @endif
                            <li class="has-children">
                                <a href="{{ route('frontend.cat') }}">{{ __('product') }}</a>
                                <ul class="sub-menu">
                                    @foreach ($procats as $k => $procat)
                                    <li><a href="{{ route('frontend.home.index') }}/menu/{{ $procat->slug.'.html' }}" title="{{ $procat->name }}"><span>{{ $procat->name }}</span></a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="{{ route('frontend.news') }}">{{ __('new') }}</a>
                                <ul class="sub-menu">
                                    @foreach ($newcategories as $k => $newcategory)
                                    @if($newcategory->hide_show == 1 and $newcategory->status == 'Published')
                                    <li><a href="{{ route('frontend.home.index') }}/tin-tuc/{{ $newcategory->slug.'.html' }}"><span>{{ $newcategory->name }}</span></a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('frontend.feedback.index') }}" title="Góp ý"><span>GÓP Ý</span></a>
                            </li>
                            @if($contacts->hide_show == 1)
                            <li>
                                <a href="{{ route('frontend.contact.index') }}" title="{{ $contacts->title }}"><span>{{ __('contact') }}</span></a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--====================  End of mobile menu overlay  ====================-->