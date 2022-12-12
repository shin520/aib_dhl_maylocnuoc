<body>
  {{-- <h1 style="position:absolute; top:-1000px;">{{ $settings->title }}</h1>
  <h2 style="position:absolute; top:-1000px;">{{ $settings->title }}</h2>
  <h3 style="position:absolute; top:-1000px;">{{ $settings->title }}</h3> --}}
  <!-- Swiper -->
  {{-- <div class="swiper-container-top-banner" style="overflow: hidden;">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img ng-src="/storage/images/banner-top-chat30s.gif" alt="VNNIC" height="60" src="/storage/images/banner-top-chat30s.gif">
      </div>
      <div class="swiper-slide">
        <img ng-src="/storage/images/banner-tong-dai-ao.gif" alt="VNNIC" height="60" src="/storage/images/banner-tong-dai-ao.gif">
      </div>
      <div class="swiper-slide">
        <img ng-src="/storage/images/header-31.jpg" alt="VNNIC" height="60" src="/storage/images/header-31.jpg">
      </div>
      <div class="swiper-slide">
        <img ng-src="/storage/images/header-32.jpg" alt="VNNIC" height="60" src="/storage/images/header-32.jpg">
      </div>
    </div>
  </div> --}}
  @php
    $items = Cart::getContent();
    $count_item = $items->count();
    // dd($items);
    @endphp
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
  {{-- <div class="nav-child">
    <div class="container">
      <div class="row">
        <div class="top-nav">
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <span style="font-size:18px; color: #F27C22"><i class="fa fa-map wolf-surprise alway-active"></i> {{ $settings->nameindex }}</span>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <a href="{{ $settings->href_1 }}" title="hotline"><i class="fa fa-phone wolf-surprise alway-active"></i> <b>{{ $settings->hotline_1 }}</b> <img src="/storage/uploads/zalo-icon.png" alt="icon zalo" title="icon zalo" style="height: 24px"></a>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <a href="{{ $settings->href_2 }}" title="hotline"><i class="fa fa-phone wolf-surprise alway-active"></i> <b>{{ $settings->hotline_2 }}</b> <img src="/storage/uploads/zalo-icon.png" alt="icon zalo" title="icon zalo" style="height: 24px"></a>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <nav class="navbar navbar-expand-xl navbar-dark bg-custom">
    {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
    <div class="container">
      {{-- <a class="navbar-brand" href="#">
      </a> --}}
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      {{-- <div class="h1-seo-title">
        <a class="navbar-brand" href="{{ route('frontend.home.index') }}" title="{{ $settings->title }}"><img class="logo" src="/storage/uploads/{{ $settings->logoindex }}" alt="{{ $settings->title }}" title="{{ $settings->title }}"></a>
      </div> --}}
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item{{--  active --}}">
            <a class="nav-link" href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> {{ __('home') }} <span class="sr-only">(current)</span></a>
          </li>
          @if($abouts->hide_show == 1)
          <li class="nav-item">
            <a class="nav-link" href="{{ route('frontend.about.index') }}" title="{{ $abouts->name }}">
              {{ __('about') }}
            </a>
          </li>
          @endif
          {{-- @foreach ($categories as $k => $category)
          @if($category->show_nav == 1 and $category->hide_show == 1 and $category->status == 'Published')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >{{ $category->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($category->articles()->get() as $article)
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html' }}" title="{{ $article->title }}">{{ $article->name }}</a>
              @endforeach
            </div>
          </li>
          @endif
          @endforeach --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('domain') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($domains as $k => $domain)
              @if($domain->hide_show == 1 and $domain->status == 'Published' and $domains = Domain::orderBy('stt', 'asc'))
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/ten-mien/{{ $domain->slug.'.html' }}" title="{{ $domain->domain }}">{{ $domain->name }}</a>
              @endif
              @endforeach
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('hosting') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($categories as $k => $category)
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/hosting/{{ $category->slug.'.html' }}" title="{{ $domain->category }}">{{ $category->name }}</a>
              @endforeach
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('email') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($webmails as $k => $webmail)
              @if($webmail->hide_show == 1 and $webmail->status == 'Published')
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/email-server/{{ $webmail->slug.'.html' }}" title="{{ $domain->webmail }}">{{ $webmail->name }}</a>
              @endif
              @endforeach
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('website') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($webs as $k => $web)
              @if($web->hide_show == 1 and $web->status == 'Published')
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/thiet-ke-website/{{ $web->slug.'.html' }}" title="{{ $domain->web }}">{{ $web->name }}</a>
              @endif
              @endforeach
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('service') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($svcategories as $k => $svcategory)
              @if($svcategory->hide_show == 1 and $svcategory->status == 'Published')
              <a class="dropdown-item" href="{{ route('frontend.home.index') }}/dich-vu/{{ $svcategory->slug.'.html' }}" title="{{ $domain->svcategory }}">{{ $svcategory->name }}</a>
              @endif
              @endforeach
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ __('new') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach ($newcategories as $k => $newcategory)
                  @if($newcategory->hide_show == 1 and $newcategory->status == 'Published')
                  <a class="dropdown-item" href="{{ route('frontend.home.index') }}/tin-tuc/{{ $newcategory->slug.'.html' }}" title="{{ $domain->newcategory }}">{{ $newcategory->name }}</a>
                  @endif
                  @endforeach
                </div>
              </li>
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link disabled" href="" title="Thư viện Demo">{{ __('demo') }}</a>
              </li>
              @if($contacts->hide_show == 1)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.contact.index') }}" title="{{ $contacts->title }}">{{ __('contact') }}</a>
              </li>
              @endif
            </ul>
            <a href="{{ route('cart.cart') }}" title="cart"><i class="ti ti-shopping-cart" style="color: #ffffff; font-size: 18px;"><span style="font-family: 'RobotoCondensed-Regular',sans-serif; margin-right: 20px"> {{ $count_item }} </span></i></a>
            <a href="{{ route('order.view') }}" title=""><i class="ti ti-shopping-cart-full" style="color: #ffffff; font-size: 18px;"><span style="font-family: 'RobotoCondensed-Regular',sans-serif; margin-right: 20px"> {{ $order->total_quantity }} </span></i></a>
            {{-- <form action="{{ route('search.index') }}" method="get" novalidate class="form-inline my-2 my-lg-0 needs-validation">
              <input class="form-control mr-sm-0 search-cus" type="search" placeholder="Tìm kiếm" aria-label="Search" name="search" id="validationCustom01" value="" required>
              <button class="btn btn-success my-2 my-sm-0 btn-custom" type="submit" id="submit"><i class="ti-search"></i></button>
            </form> --}}
            <div class="lang">
              <a href="{{ route('frontend.locale.index',['vi']) }}" class="lang-vi vi" title="Vietnamese"></a>
              <a href="{{ route('frontend.locale.index',['en']) }}" class="lang-en en" title="English"></a>
            </div>
          </div>
        </nav>
      </div>
      {{-- <div id="menu_area" class="menu-area">
        <div class="container">
          <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu bg-custom ">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="h1-seo-title">
                <h1><a class="navbar-brand" href="{{ route('frontend.home.index') }}" title="{{ $settings->title }}"><img class="logo" src="/storage/uploads/{{ $settings->logoindex }}" alt="{{ $settings->title }}" title="{{ $settings->title }}"></a></h1>
              </div>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="active"><a href="{{ route('frontend.home.index') }}" title="{{ $settings->title }}">Trang chủ <span class="sr-only">(current)</span></a></li>
                  @if($abouts->hide_show == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.about.index') }}" title="{{ $abouts->name }}">
                      {{ $abouts->name }}
                    </a>
                  </li>
                  @endif
                  @foreach ($categories as $k => $category)
                  @if($category->show_nav == 1 and $category->hide_show == 1 and $category->status == 'Published')
                  <li class="dropdown">
                    <a class="dropdown-toggle" href="/bang-gia/{{ $category->slug.'.html' }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      @foreach ($category->articles()->get() as $article)
                      <li><a href="{{ $article->slug.'.html' }}">{{ $article->name }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                  @endif
                  @endforeach
                  @if($contacts->hide_show == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.contact.index') }}" title="{{ $contacts->title }}">{{ $contacts->name }}</a>
                  </li>
                  @endif
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div> --}}
      <!-- Swiper -->