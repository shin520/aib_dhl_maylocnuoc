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
                                <span class="mobile-navigation-close-icon"
                                    id="mobile-menu-close-trigger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-overlay__body">
                <nav class="offcanvas-navigation">
                    <ul class="ul-cus">
                        <li class="has-children">
                            <a href="{{ url('/') }}"
                                title="{{ $setting->translations->name }}">Trang
                                chủ</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{ route('frontend.slug',$menu['about-us']->translations->slug) }}"
                                title="{{ $setting->translations->name }}"><span>Giới
                                    thiệu</span></a>
                        </li>
                        {{-- <li><a href="{{ route('frontend.slug',$menu['order']->translations->slug) }}">Đặt Hàng</a></li> --}}

                        <li class="has-children">
                            <a href="{{ route('frontend.slug',$menu['all-product']->translations->slug) }}">Sản phẩm</a>
                            <ul class="sub-menu">
                                @foreach ($menu['procatone_list'] as $item)
                                <li class="has-children">
                                    <a href="{{ route('frontend.slug',$item->translations->slug) }}">{{ $item->translations->name }}</a>
                                    <ul class="{{ $item->procat2->count() > 0 ? 'sub-menu': '' }}">
                                        @foreach ($item->procat2 as $items)
                                        <li><a href="{{ route('frontend.slug',$items->translations->slug) }}"><span>{{ $items->translations->name }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('frontend.slug',$menu['all_policy']->translations->slug) }}">Chính Sách</a>
                        </li>
                        <li>
                        <a rel="nofollow" href="{{ route('frontend.slug',$menu['all_video']->translations->slug) }}" title="VIDEOS"><span>Videos</span></a>
                        </li>
                        {{-- <li>
                            <a rel="nofollow" href="{{ route('frontend.slug',$menu['all-service']->translations->slug) }}"
                                title="Dịch Vụ"><span>Dịch vụ</span></a>
                        </li> --}}
                        {{-- <li>
                            <a rel="nofollow" href="{{ route('frontend.slug',$menu['all-service']->translations->slug) }}"
                                title="Dịch Vụ"><span>Bảng giá</span></a>
                        </li> --}}
                        <li class=""><span class="menu-expand"><i></i></span>
                            <a href="{{ route('frontend.slug',$menu['all_post']->translations->slug) }}">Tin tức</a>
                            <ul class="sub-menu" style="display: none;">
                            </ul>
                        </li>
                        <li><a href="{{ route('frontend.slug',$menu['recrui']->translations->slug) }}">Tuyển dụng</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{ route('frontend.slug',$menu['contact']->translations->slug) }}"
                                title="Liên hệ"><span>Liên hệ</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--====================  End of mobile menu overlay  ====================-->
</div>
