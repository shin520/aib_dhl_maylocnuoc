<div class="header-area bg-pink bg-custom header-sticky only-mobile-sticky">
    <div class="container">
        <div>
            <!-- brand logo -->
            <div class="header__logo">
            </div>
            <div class="flexible-image-slider-wrap">
                <div id="hidden-icon-wrapper">
                    <div class="header-bottom-wrap d-md-block d-none header-sticky">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-3 menu__left d-xl-block d-none">
                                    <div class="mega-menu-title">
                                        <h2 data-toggle="collapse" data-target="#sidebar" aria-expanded="false"
                                            aria-controls="sidebar" class="bar__menu_sideleft">
                                            <i class="fa-solid fa-bars"></i> DANH MỤC SẢN PHẨM
                                        </h2>
                                    </div>
                                    <div class="collapse" id="sidebar">
                                        <div class="mega-menu-category block">
                                            <ul class="nav">
                                                @php
                                                    $procatones = DB::table('procatones')
                                                        ->orderBy('stt', 'asc')
                                                        ->orderBy('id', 'desc')
                                                        ->get();
                                                @endphp
                                                @foreach ($procatones as $procatone)
                                                    <li>
                                                        {{-- @if ($item->procat2->count() > 0)
                                                        <i href="#tab{{ $item->translations->slug }}" data-toggle="collapse" aria-expanded="false" class="fa-regular fa-chevron-down"></i>
                                                        @endif
                                                        <ul class="sub-menu list-unstyled" id="tab{{ $item->translations->slug }}">
                                                            @foreach ($item->procat2 as $item2)
                                                            <li>
                                                                <a href="{{ route('frontend.slug',$item->translations->slug) }}">{{ $item2->translations->name }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul> --}}
                                                        <img src="/images/index-cate-icon-1.png"
                                                            alt="{{ $procatone->name }}" />
                                                        <a
                                                            href="{{ route('frontend.home.index') }}/san-pham/{{ $procatone->slug . '.html' }}">{{ $procatone->name }}</a>
                                                        @php
                                                            $procattwos = DB::table('procattwos')
                                                                ->where('procatone_id', $procatone->id)
                                                                ->orderBy('stt', 'asc')
                                                                ->orderBy('id', 'desc')
                                                                ->get();
                                                        @endphp
                                                        @if ($procattwos->isNotEmpty())
                                                            <ul class="sub-menu list-unstyled"
                                                                id="tab{{ $item->slug }}">
                                                                @foreach ($procattwos as $procattwo)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('frontend.home.index') }}/san-pham/{{ $procattwo->slug . '.html' }}">{{ $procattwo->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="header-bottom-inner">
                                        <div class="header-bottom-left-wrap">
                                            <!-- navigation menu -->
                                            <div class="header__navigation d-none d-xl-block">
                                                <nav class="navigation-menu">
                                                    <ul>
                                                        {{-- <li><a href="{{ url('/') }}">
                                                                <img class="icon__home" width="35px"
                                                                    src="{{ asset('core/frontend/img/iconhome.svg') }}"
                                                                    alt="Trang chủ">
                                                            </a></li> --}}
                                                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                                                        <li><a
                                                                href="{{ route('frontend.about.index') }}">Giới
                                                                thiệu</a></li>
                                                        <li><a
                                                                href="{{ route('frontend.cat') }}">Sản phẩm</a>
                                                        </li>
                                                        <li><a
                                                                href="/dich-vu.html">Dịch vụ</a>
                                                        </li>
                                                        <li><a
                                                                href="/tin-tuc.html">Tin tức</a>
                                                        </li>
                                                        <li><a
                                                                href="/lien-he.html">Liên hệ</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="header-search-form d-xl-none">
                        <form action="{{ route('frontend.search') }}" class="search-form-top">
                            <input class="search-field" type="text" name="timkiem"
                                placeholder="Nhập từ khóa tìm kiếm...">
                            <button class="search-submit">
                                <i style="color: #007640" class="search-btn-icon fa fa-search"></i>
                            </button>
                        </form>
                    </div> --}}
                </div>
                <div class="mobile-navigation-icon d-block d-xl-none" id="mobile-menu-trigger">
                    <i></i>
                </div>
            </div>
        </div>
    </div>
</div>
