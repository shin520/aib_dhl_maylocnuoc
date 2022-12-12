@extends('frontend.layout.master-layout')
@section('content')
    @include('frontend.layout.slider')
    <section class="awe-section-2">
        <div class="section_deal">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="home-title">
                            <h2><a href="#">Sản phẩm nổi bật</a></h2>
                        </div>
                    </div>
                    <div class="col-md-12 e-tabs not-dqtab ajax-tab-1" data-section="ajax-tab-1">
                        <div class="content">
                            <div>
                                <div class="tab-2 tab-content">
                                    <div class="section-tour-owl products products-view-grid owl-carousel" data-lg-items='6'
                                        data-md-items='6' data-sm-items='3' data-xs-items="2" data-xss-items="2"
                                        data-margin='10' data-nav="true" data-dot="true">
                                        @foreach ($pro_news as $product)
                                            <div class="item">
                                                <div class="product-item">
                                                    <div class="product-item-container grid-view-item">
                                                        <div class="left-block">
                                                            <div class="product-image-container product-image">
                                                                <a class="grid-view-item__link image-ajax"
                                                                    href="{{ route('frontend.home.index') }}/{{ $product->slug . '.html' }}">
                                                                    @php
                                                                        $img = $product->img;
                                                                    @endphp
                                                                    <img class="first-img img-responsive center-block"
                                                                        src="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                        data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                        alt="{{ $product->name }}" />
                                                                </a>
                                                            </div>
                                                            <div class="button-link">
                                                                <div class="btn-button add-to-cart action">
                                                                    <form action="" method="post"
                                                                        class="variants form-nut-grid"
                                                                        data-id="product-actions-16091515"
                                                                        enctype="multipart/form-data">
                                                                        <button
                                                                            class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to"
                                                                            title="Chi tiết" type="button"
                                                                            onclick="window.location.href='/{{ $product->slug . '.html' }}'">
                                                                            <i class="ion ion-md-redo"></i> Chi tiết
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class="quickview-button">
                                                                    <a class="visible-lg btn_df" title="Xem nhanh">
                                                                        <i class="ion ion-md-search quickviewproduct"
                                                                            data-slug="{{ $product->slug }}"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4 class="title-product">
                                                                    <a class="product-name line-clamp"
                                                                        href="{{ route('frontend.home.index') }}/{{ $product->slug . '.html' }}"
                                                                        title="{{ $product->title }}">{{ $product->name }}</a>
                                                                </h4>
                                                                @if ($product->discount == 0 && $product->price > 0)
                                                                    <div class="price">
                                                                        <span class="price-new">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->price) }}₫</span>
                                                                        </span>
                                                                    </div>
                                                                @elseif($product->discount > 0)
                                                                    <div class="price">
                                                                        <span class="price-old">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->price) }}₫</span>
                                                                        </span>
                                                                        <span class="price-new">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->selling_price) }}₫</span>
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div class="price">
                                                                        <span class="price-new">
                                                                            <span class="money">Liên hệ</span>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-3 tab-content">
                                    <div class="section-tour-owl products products-view-grid owl-carousel" data-lg-items='6'
                                        data-md-items='6' data-sm-items='3' data-xs-items="2" data-xss-items="2"
                                        data-margin='10' data-nav="true" data-dot="true">
                                        @foreach ($pro_discounts as $product)
                                            <div class="item">
                                                <div class="product-item">
                                                    <div class="product-item-container grid-view-item">
                                                        <div class="left-block">
                                                            <div class="product-image-container product-image">
                                                                <a class="grid-view-item__link image-ajax"
                                                                    href="{{ route('frontend.home.index') }}/{{ $product->slug . '.html' }}">
                                                                    @php
                                                                        $img = $product->img;
                                                                    @endphp
                                                                    <img class="first-img img-responsive center-block"
                                                                        src="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                        data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                        alt="{{ $product->name }}" />
                                                                </a>
                                                            </div>
                                                            <div class="button-link">
                                                                <div class="btn-button add-to-cart action">
                                                                    <form action="" method="post"
                                                                        class="variants form-nut-grid"
                                                                        data-id="product-actions-16091515"
                                                                        enctype="multipart/form-data">
                                                                        <button
                                                                            class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to"
                                                                            title="Chi tiết" type="button"
                                                                            onclick="window.location.href='/{{ $product->slug . '.html' }}'">
                                                                            <i class="ion ion-md-redo"></i> Chi tiết
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class="quickview-button">
                                                                    <a class="visible-lg btn_df" title="Xem nhanh">
                                                                        <i class="ion ion-md-search quickviewproduct"
                                                                            data-slug="{{ $product->slug }}"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4 class="title-product">
                                                                    <a class="product-name line-clamp"
                                                                        href="{{ route('frontend.home.index') }}/{{ $product->slug . '.html' }}"
                                                                        title="{{ $product->title }}">{{ $product->name }}</a>
                                                                </h4>
                                                                @if ($product->discount == 0 && $product->price > 0)
                                                                    <div class="price">
                                                                        <span class="price-new">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->price) }}₫</span>
                                                                        </span>
                                                                    </div>
                                                                @elseif($product->discount > 0)
                                                                    <div class="price">
                                                                        <span class="price-old">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->price) }}₫</span>
                                                                        </span>
                                                                        <span class="price-new">
                                                                            <span
                                                                                class="money">{{ product_price_view($product->selling_price) }}₫</span>
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <div class="price">
                                                                        <span class="price-new">
                                                                            <span class="money">Liên hệ</span>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="awe-section-3">
        <div class="section_banner_2">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="{{ route('frontend.cat') }}">
                            <img src="/images/banner_1.jpg" data-lazyload="/images/banner_1.jpg"
                                class="img-responsive center-block" alt="Banner" />
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="{{ route('frontend.cat') }}">
                            <img src="/images/banner_2.jpg" data-lazyload="/images/banner_2.jpg"
                                class="img-responsive center-block" alt="Banner" />
                        </a>
                    </div> --}}
                    <img src="{{ imageUrl('/storage/uploads/' . $setting->banner_index, '1300', '350', '100', '1') }}" alt="banner trang chủ">
                </div>
            </div>
        </div>
    </section>
    @foreach ($cateparent as $procate)
        <section class="awe-section-5">
            <div class="section_product section_product_4 color_group_2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="group-top-product">
                                <h2 class="section_product_title">{{ $procate->name }}</h2>
                                {{-- @php
              $catchild = DB::table('productcategories')->where('parent_id', $procate->id)->get();
            @endphp
            @foreach ($catchild as $item)
              <li><a>{{ $item->name }}</a></li>
            @endforeach --}}
                            </div>
                        </div>
                    </div>
                    <div class="row grp-nature">
                        <div class="col-md-12 product_4 no-padding">
                            <div class="group-list-product clearfix">
                                @php
                                    // $cateall = \App\Models\Productcategory::all();
                                    // $mangdb = array();
                                    // recursiveSelect($cateall, $procate->id, $mangdb);
                                    // $mangdb[] = array($procate->id);
                                    // $product = DB::table('product_productcategory')
                                    //     ->select('products.*')
                                    //     ->join('productcategories', 'productcategories.id', '=', 'product_productcategory.productcategory_id')
                                    //     ->join('products', 'products.id', '=', 'product_productcategory.product_id')
                                    //     ->whereIn('product_productcategory.productcategory_id', $mangdb)
                                    //     ->where('products.hide_show',1)
                                    //     ->where('products.is_featured',1)
                                    //     ->get()->take(8);
                                    
                                    // $product = DB::table('product_productcategory')
                                    //     ->select('products.*')
                                    //     ->join('products', 'products.id', '=', 'product_productcategory.product_id')
                                    //     ->join('productcategories', 'productcategories.id', '=', 'product_productcategory.productcategory_id')
                                    //     ->where('products.is_featured',1)
                                    //     ->where('productcategory_id',$procate->id)
                                    //     ->get();
                                    $pro_featureds = Product::where('procatone_id', $procate->id)
                                        ->orderBy('stt', 'asc')
                                        ->orderBy('id', 'desc')
                                        // ->orWhere('procattwo_id', $product->procattwo_id)
                                        // ->orWhere('procatthree_id', $product->procatthree_id)
                                        ->where('hide_show', 1)
                                        ->where('is_featured', 1)
                                        ->get();
                                        // ->take(8);
                                    // dd($pro_featureds);
                                @endphp
                                <div class="row">
                                  @foreach ($pro_featureds as $item)
                                      <div class="col-md-3 col-6 no-padding product_4s">
                                          <div class="products-view-grid">
                                              <div class="product-item">
                                                  <div class="product-item-container grid-view-item">
                                                      <div class="left-block">
                                                          <div class="product-image-container product-image">
                                                              <a class="grid-view-item__link image-ajax"
                                                                  href="{{ route('frontend.home.index') }}/{{ $item->slug . '.html' }}">
                                                                  @php
                                                                      $img = $item->img;
                                                                  @endphp
                                                                  <img class="first-img img-responsive center-block"
                                                                      src="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                      data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                                      alt="{{ $item->name }}" />
                                                              </a>
                                                          </div>
                                                          <div class="button-link">
                                                              <div class="btn-button add-to-cart action">
                                                                  <form action="" method="post"
                                                                      class="variants form-nut-grid" data-id=""
                                                                      enctype="multipart/form-data">
                                                                      <button
                                                                          class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to"
                                                                          title="Chi tiết" type="button"
                                                                          onclick="window.location.href='/{{ $item->slug . '.html' }}'">
                                                                          <i class="ion ion-md-redo"></i> Chi tiết
                                                                      </button>
                                                                  </form>
                                                              </div>
                                                              <div class="quickview-button">
                                                                  <a class="visible-lg btn_df" title="Xem nhanh">
                                                                      <i class="ion ion-md-search quickviewproduct"
                                                                          data-slug="{{ $item->slug }}"></i>
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="right-block">
                                                          <div class="caption">
                                                              <h4 class="title-product">
                                                                  <a class="product-name line-clamp" href="/trimion-gracia"
                                                                      title="Trimion Gracia">{{ $item->name }}</a>
                                                              </h4>
                                                              @if ($item->discount == 0 && $item->price > 0)
                                                                  <div class="price">
                                                                      <span class="price-new">
                                                                          <span
                                                                              class="money">{{ product_price_view($item->price) }}₫</span>
                                                                      </span>
                                                                  </div>
                                                              @elseif($item->discount > 0)
                                                                  <div class="price">
                                                                      <span class="price-old">
                                                                          <span
                                                                              class="money">{{ product_price_view($item->price) }}₫</span>
                                                                      </span>
                                                                      <span class="price-new">
                                                                          <span
                                                                              class="money">{{ product_price_view($item->selling_price) }}₫</span>
                                                                      </span>
                                                                  </div>
                                                              @else
                                                                  <div class="price">
                                                                      <span class="price-new">
                                                                          <span class="money">Liên hệ</span>
                                                                      </span>
                                                                  </div>
                                                              @endif
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-md-3-right no-padding">
                            <div class="banner d-sm-block d-xs-block">
                                {{-- <a href="#">
                                    @php
                                        $img = $procate->img;
                                    @endphp
                                    <img src="{{ imageUrl('/storage/uploads/' . $img, '100%', '597', '100', '1') }}"
                                        data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '100%', '597', '100', '1') }}"
                                        class="img-responsive center-block" alt="{{ $procate->name }}" />
                                </a> --}}
                                {{-- <a href="#">
                                    @php
                                        $img = $procate->img;
                                    @endphp
                                    <img src="{{ asset('/storage/uploads/' . $img) }}"
                                        data-lazyload="{{ asset('/storage/uploads/' . $img) }}"
                                        class="img-responsive center-block" alt="{{ $procate->name }}" />
                                </a> --}}
                                <a href="#">
                                    @php
                                        $img = $procate->img;
                                    @endphp  
                                    <img src="{{ imageUrl('/storage/uploads/' . $img, '1300', '350', '100', '1') }}"
                                        data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '1300', '350', '100', '1') }}"
                                        class="img-responsive center-block" alt="{{ $procate->name }}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
        @php
            $data['post'] = App\Models\Post::whereHide_show(1)->orderby('stt','asc')->orderby('id','desc')->get();
        @endphp
        @push('style')
        <style>
            /*! CSS Used from: https://dochoixemaytanphu.com/frontend/asset/css/style.css */
            *{box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;outline:none;margin:0;}
            img{max-width:100%;height:auto;vertical-align:middle;}
            iframe{max-width:100%;}
            a{text-decoration:none;outline:none;}
            a:hover,a:focus{color:unset;outline:none;}
            h3,h4{font-weight:normal;font-size:initial;}
            .margin_auto{width:1188px;margin:0 auto;position:relative;}
            .select_video{width:100%;margin-top:10px;}
            .select_video select{width:100%;padding:10px;outline:none;color:#5c5c5c;font-weight:500;text-indent:5px;font-size:1.5rem;border:1px solid #d6d6d6;}
            .select_video::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0, 0, 0, 0.1);background-color:#F5F5F5;border-radius:10px;}
            .select_video::-webkit-scrollbar{width:5px;background-color:#F5F5F5;}
            .select_video::-webkit-scrollbar-thumb{border-radius:10px;background-color:#FFF;background-image:-webkit-linear-gradient(top, #e4f5fc 0%, #bfe8f9 50%, #9fd8ef 51%, #2ab0ed 100%);}
            .clip_bt .khung_video{display:flex;flex-wrap:wrap;justify-content:space-between;}
            .khung_video .video-container{width:100%;}
            .bottom_w{width:100%;padding-bottom:50px;}
            .bottom_w .margin_auto{display:flex;justify-content:space-between;flex-wrap:wrap;}
            .tintuc_bt{width:50%;padding-right:15px;}
            .thanh_bt{width: 100%;margin-top: 40px;background: var(--main_color);height: 44px;margin-bottom: 30px;}
            .thanh_bt h4{display:inline-block;font-size:25px;color:#fff;font-family:'UTMImpact';text-transform:uppercase;background:url(https://dochoixemaytanphu.com/frontend/asset/img/bg_bt.jpeg) repeat-x;padding:0 35px;position:relative;line-height:58px;margin-top:-7px;}
            .thanh_bt h4:after{content:'';width:21px;height:100%;background:url(https://dochoixemaytanphu.com/frontend/asset/img/bg_bt.jpeg) repeat-x;position:absolute;top:0;left:calc(100% - 0.5px);clip-path:polygon(0 0, 1% 100%, 100% 100%);}
            .sim_tin{position:relative;}
            .sim_tin:after{content:'';width:1px;height:100%;background:#999999;position:absolute;top:0;left:52px;}
            .khung_tin{position:relative;}
            .khung_tin:before{content:'';width:9px;height:9px;background:#999999;position:absolute;top:0;left:48px;border-radius:50%;}
            .khung_tin:after{content:'';width:9px;height:9px;background:#999999;position:absolute;bottom:0;left:48px;border-radius:50%;}
            .item_tin{display:flex;align-items:center;justify-content:space-between;}
            .num_tin{width: 32px;height: 32px;display: flex;align-items: center;justify-content: center;font-weight: 500;color: #fff;border-radius: 50%;background: var(--main_color);}
            .info_tin{width:calc(100% - 73px);display:flex;align-items:center;justify-content:space-between;position:relative;border-bottom:1px dotted #b2b2b2;}
            .info_tin:after{content: '';width: 18px;height: 18px;position: absolute;top: 50%;border-radius: 50%;left: -30px;transform: translateY(-50%);z-index: 1;background: var(--main_color);}
            .info_tin>a{display:block;width:137px;}
            .mota_tin{width:calc(100% - 150px); overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; line-clamp: 2; -webkit-box-orient: vertical;}
            .mota_tin h3 a{color:#000;font-size:15px;font-weight:500;}
            .date_tin span{font-size:13px;color:#808080;}
            .date_tin a{display:inline-block;font-weight:500;color:var(--main_color);margin-left:10px;font-style:italic;}
            .clip_bt{width:50%;padding-left:15px;}
            .vert .simply-scroll-list .item_tin .info_tin{margin-bottom:10px!important;padding-bottom:10px!important;}
            .vert .simply-scroll-list{height:auto!important;}
            .hover_zoom{box-shadow:2px 2px 2px #f2ebeb;position:relative;overflow:hidden;}
            .hover_zoom img{-webkit-transform:scale(1);transform:scale(1);-webkit-transition:.3s ease-in-out;transition:.3s ease-in-out;position:relative;}
            .hover_zoom:hover img{-webkit-transform:scale(1.09);transform:scale(1.09);}
            @media (max-width:1200px){
            .margin_auto{width:100%;padding:0 10px;}
            }
            @media (max-width:768px){
            .tintuc_bt{width:100%;padding:0;}
            .clip_bt{width:100%;padding:0;}
            .bottom_w{padding-bottom:30px;}
            }
            @media (max-width:500px){
            .num_tin,.khung_tin:before,.sim_tin:after{display:none;}
            .info_tin{width:100%;}
            .thanh_bt h4{font-size:1.4em;line-height:50px;}
            }
            /*! CSS Used from: https://dochoixemaytanphu.com/frontend/asset/css/jquery.simplyscroll.css */
            .simply-scroll-container{position:relative;}
            .simply-scroll-clip{position:relative;overflow:hidden;}
            .simply-scroll-list{overflow:hidden;margin:0;padding:0;list-style:none;}
            .vert{height:400px;}
            .vert .simply-scroll-clip{width:100%;height:400px;}
            /*! CSS Used from: https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css */
            *,::after,::before{box-sizing:border-box;}
            h3,h4{margin-top:0;margin-bottom:.5rem;}
            a{color:#007bff;text-decoration:none;background-color:transparent;}
            a:hover{color:#0056b3;text-decoration:underline;}
            img{vertical-align:middle;border-style:none;}
            select{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
            select{text-transform:none;}
            select{word-wrap:normal;}
            h3,h4{margin-bottom:.5rem;font-weight:500;line-height:1.2;}
            h3{font-size:1.75rem;}
            h4{font-size:1.5rem;}
            @media print{
            *,::after,::before{text-shadow:none!important;box-shadow:none!important;}
            a:not(.btn){text-decoration:underline;}
            img{page-break-inside:avoid;}
            h3{orphans:3;widows:3;}
            h3{page-break-after:avoid;}
            }
            /*! CSS Used from: https://dochoixemaytanphu.com/frontend/asset/css/mystyle.css */
            h3 a{font-size:15px;}
            h3{font-size:1.5rem;}
            a{color:black;}
        </style>
        @endpush
        @push('script') 
            <script type="text/javascript">
                (function ($) {
                    $(function () {
                        $(".sim_tin").simplyScroll({
                            orientation: 'vertical',
                            customClass: 'vert'
                        });
                    });
                })(jQuery);
            </script>
            <script>
                $('.select_video').on('change', function() {
                    var iframe = $('#iframe_video');
                    var value = $('.select_video :selected').val();
                    var url = 'https://www.youtube.com/embed/'+value;
                    iframe.attr("src",url);
            });
            </script>
        @endpush
    <section class="awe-section-news-and-video">
        <div class="container">
            <div class="row">
                <div class="tintuc_bt">
                    <div class="thanh_bt">
                        <h4>Tin tức</h4>
                    </div>
                    <div class="khung_tin">
                        <div class="sim_tin">
                            @foreach ($data['post'] as $item)
                                <div class="item_tin">
                                    <div class="num_tin">
                                        {{ $loop->iteration }} </div>
                                    <div class="info_tin">
                                        <a class="hover_zoom" href="{{ route('frontend.dtpost.index', $item->slug) }}"><img
                                                src="{{ asset('storage/uploads')}}/{{$item->img}}"
                                                alt="{{ $item->title }}"></a>
                                        <div class="mota_tin">
                                            <h3><a
                                                    href="{{ route('frontend.dtpost.index', $item->slug) }}">{{ $item->name }}</a>
                                            </h3>
                                            <div class="date_tin">
                                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format(' d-m-Y') }}
                                                </span>
                                            </div>
                                            {!! $item->descriptions !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clip_bt">
                    <div class="thanh_bt">
                        <h4>Video</h4>
                    </div>
                    <div class="khung_video">

                        @php
                            $data['video'] = App\Models\Video::whereHide_show(1)->orderby('stt','asc')->orderby('id','desc')->get()->take(4);
                        @endphp
                        <iframe id="iframe_video" style="width: 100%"
                            src="https://www.youtube.com/embed/{{$data['video']->first()->url_code}}" frameborder="0" height="300"
                            allowfullscreen></iframe>

                        @foreach ($data['video']->take(1) as $item)
                        @endforeach
                        <div class="select_video"><select width="100%" id="video_lienquan">
                            @foreach ($data['video'] as $item)
                                <option value="{{ $item->url_code }}">{{ $item->name }}</option>
                            @endforeach
                        </select></div>
                    </div>
                </div>
            </div>
        </div>
    </section>   

    <section class="awe-section-9">
        <div class="section_index_brand">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="brand-owl owl-carousel not-dqowl">
                            @foreach ($sliders as $slider)
                                @if ($slider->type == 'other')
                                    <div class="item">
                                        <a href="{{ $slider->url }}" target="_blank" rel="nofollow">
                                            @php
                                                $img = $slider->img;
                                            @endphp
                                            <img src="{{ imageUrl('/storage/uploads/' . $img, '183', '102', '100', '1') }}"
                                                data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '183', '102', '100', '1') }}"
                                                alt="{{ $slider->name }}" class="img-responsive center-block"
                                                style="max-height:104px;" />
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="awe-section-10">
        <div class="section_index_criteria">
            <div class="container">
                <div class="row">
                    @php
                        $data['criteria'] = App\Models\Criteria::whereHide_show(1)->orderby('stt','asc')->orderby('id','desc')->get()->take(3);
                    @endphp
                    @foreach ($data['criteria'] as $item)
                        <div class="col-lg-4 col-md-12 col-sm-12 tx01 mb-sm-4">
                            <div class="criteria_display_index h-100">
                                <div class="col-3">
                                    <div class="img">
                                        <img src="{{imageUrl('storage/uploads/'.$item->img, '100', '100', '100', '1')}}" alt="{{$item->name}}">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="info">
                                        <div class="title">{{$item->name}}</div>
                                        <div class="content">{!!$item->content!!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                autoplay: true,
                dots: true,
                loop: true,
                margin: 30,
                navigation: true,
                pagination: true,
                lazyLoad: true,
                singleItem: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    900: {
                        items: 2
                    }
                }
            });
        });
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}/#organization","name":"{{ $setting->nameindex }}","url":"{{ $setting->website }}/","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}/#logo","inLanguage":"{{ $setting->locale }}","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}/#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}/#website","url":"{{ route('frontend.home.index') }}/","name":"{{ $setting->nameindex }}","inLanguage":"{{ $setting->locale }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}/#organization"}},{"@type":["WebPage"],"@id":"{{ route('frontend.home.index') }}/#webpage","url":"{{ route('frontend.home.index') }}/","name":"{{ $setting->nameindex }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}/#website"},"inLanguage":"{{ $setting->locale }}","about":{"@id":"{{ route('frontend.home.index') }}/#organization"},"datePublished":"2019-06-06T08:20:25+00:00","dateModified":"2020-02-01T10:26:32+00:00","description":"{{ $setting->description }}"}]}</script>
@endpush