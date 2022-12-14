<body>
    <header class="header">
        <div class="topbar">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-sm-12">
                        <ul class="top-left-info">
                            @foreach ($sliders as $slider)
                                @if ($slider->type == 'social')
                                    <li><a target="_blank" rel="nofollow" href="{{ $slider->url }}">{!! $slider->icon !!}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <ul class="top-right-info d-xs-none">
                        <li>
                            <a href="/lien-he.html"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{ $setting->address }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="header-main">
                <div class="row">
                    <div class="col-md-3 col-100-h">
                        <button type="button" class="navbar-toggle collapsed d-sm-block d-md-none"
                            id="trigger-mobile">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo">
                            <a href="/" class="logo-wrapper">
                                <img src="/storage/uploads/{{ $setting->logoindex }}" title="{{ $setting->nameindex }}"
                                    alt="logo {{ $setting->nameindex }}">
                            </a>
                        </div>
                        <div class="mobile-cart d-sm-none d-xs-none">
                            <a href="{{ route('order.view') }}" title="Gi??? h??ng">
                                <i class="fa fa-shopping-bag"></i>
                                <div class="cart-right">
                                    <span class="count_item_pr">{{ $order->total_quantity }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="search">
                            <div class="header_search search_form">
                                <form class="input-group search-bar search_form" action="{{ route('search.index') }}"
                                    method="get" role="search">
                                    <input type="search" name="search" value=""
                                        placeholder="T??m ki???m s???n ph???m... "
                                        class="input-group-field st-default-search-input search-text" required>
                                    <span class="input-group-btn">
                                        <button class="btn icon-fallback-text">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-md-block d-none">
                        <div class="header-right clearfix">
                            <div class="top-cart-contain f-right">
                                <div class="mini-cart text-xs-center">
                                    <div class="heading-cart cart_header">
                                        <a href="{{ route('order.view') }}" class="content_cart_header">
                                            <div class="d-flex align-items-center">
                                                <div class="icon_hotline    ">
                                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                </div>
                                                <span class="text-white">({{ $order->total_quantity }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="hotline_dathang f-right d-sm-block draw">
                                <div class="icon_hotline">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="content_hotline" data-toggle="tooltip" data-placement="bottom"
                                    title="T???ng ????i mi???n ph??">
                                    <a href="tel:{{ $setting->hotline_1 }}">{{ $setting->hotline_1 }}</a>
                                    <a href="tel:{{ $setting->hotline_2 }}">{{ $setting->hotline_2 }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="d-lg-block d-none">
            <div class="container">
                <div class="row justify-content-between">
                  <div class="col-lg-3 col-12 no-padding">
                      <div class="mainmenu">
                          <span><i class="ion ion-ios-keypad"></i> Danh m???c s???n ph???m</span>
                          <div class="nav-cate">
                              <ul id="menu">
                                  @php
                                      $procatones = DB::table('procatones')
                                          ->orderBy('stt', 'asc')
                                          ->orderBy('id', 'desc')
                                          ->get();
                                  @endphp
                                  @foreach ($procatones as $procatone)
                                      <li class="dropdown menu-item-count clearfix">
                                          <h3>
                                              <img src="/images/index-cate-icon-1.png" alt="{{ $procatone->name }}" />
                                              <a
                                                  href="{{ route('frontend.home.index') }}/san-pham/{{ $procatone->slug . '.html' }}">{{ $procatone->name }}</a>
                                          </h3>
                                          @php
                                              $procattwos = DB::table('procattwos')
                                                  ->where('procatone_id', $procatone->id)
                                                  ->orderBy('stt', 'asc')
                                                  ->orderBy('id', 'desc')
                                                  ->get();
                                          @endphp
                                          @if ($procattwos->isNotEmpty())
                                              <div class="nav-cate subcate gd-menu">
                                                  <ul>
                                                      @foreach ($procattwos as $procattwo)
                                                          <li class="dropdown menu-item-count clearfix">
                                                              <a
                                                                  href="{{ route('frontend.home.index') }}/san-pham/{{ $procattwo->slug . '.html' }}">{{ $procattwo->name }}</a>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                          @endif
                                      </li>
                                  @endforeach
                              </ul> 
                          </div>
                      </div>
                  </div>
                  <div class="col d-none d-lg-block no-padding">
                      <ul id="nav" class="nav d-flex justify-content-between">
                          @php
                              $segment1 = Request::segment(1);
                          @endphp
                          <li class="nav-item {{ $segment1 == null ? 'active' : '' }}"><a class="nav-link"
                                  href="/">Trang ch???</a></li>
                          <li class="nav-item {{ $segment1 == 'gioi-thieu.html' ? 'active' : '' }}"><a class="nav-link"
                                  href="{{ route('frontend.about.index') }}">Gi???i thi???u</a></li>
                          <li class="nav-item has-mega {{ $segment1 == 'san-pham.html' ? 'active' : '' }}">
                              <a href="{{ route('frontend.cat') }}" class="nav-link">S???n ph???m</a>
                          </li>
                          <li class="nav-item {{ $segment1 == 'dich-vu.html' ? 'active' : '' }}"><a class="nav-link"
                                  href="/dich-vu.html">D???ch v???</a></li>
                          <li class="nav-item {{ $segment1 == 'tin-tuc.html' ? 'active' : '' }}"><a class="nav-link"
                                  href="/tin-tuc.html">Tin t???c</a></li>
                          <li class="nav-item {{ $segment1 == 'lien-he.html' ? 'active' : '' }}"><a class="nav-link"
                                  href="/lien-he.html">Li??n h???</a></li>
                      </ul>
                  </div>
                </div>
            </div>
        </nav>
    </header>
    <h1 class="d-none">{{ $setting->description }}</h1>
