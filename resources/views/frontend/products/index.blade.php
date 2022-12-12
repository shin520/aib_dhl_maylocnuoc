@extends('frontend.layout.master-layout')
@section('content')

    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <li class="home">
                            <a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        <li class="home">
                            <a itemprop="url" href="/san-pham.html" title="Sản phẩm"><span itemprop="title">Sản
                                    phẩm</span></a>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        @if (!is_null($product->procatone_id))
                            @php
                                $data = DB::table('procatones')
                                    ->where('id', $product->procatone_id)
                                    ->first();
                            @endphp
                            <li>
                                <strong><span itemprop="title"><a
                                            href="/san-pham/{{ $data->slug . '.html' }}">{{ $data->name }}</a></span></strong>
                                <span><i class="fa fa-angle-right"></i></span>
                            <li>
                        @endif
                        @if (!is_null($product->procattwo_id))
                            @php
                                $data = DB::table('procattwos')
                                    ->where('id', $product->procattwo_id)
                                    ->first();
                            @endphp
                            <li>
                                <strong><span itemprop="title"><a
                                            href="/san-pham/{{ $data->slug . '.html' }}">{{ $data->name }}</a></span></strong>
                                <span><i class="fa fa-angle-right"></i></span>
                            <li>
                        @endif
                        {{-- @if (!is_null($product->procatthree_id))
              @php
                $data = DB::table('procatthrees')->where('id', $product->procatthree_id)->first();
              @endphp
            <li><strong><span itemprop="title">{{ $data->name }}</span></strong>
              <span><i class="fa fa-angle-right"></i></span>
              <li>
          @endif --}}
                        {{-- @foreach ($allDataBreadCrumb as $name)
          <li>
            <a class="{{ ($loop->last) ? 'active' : '' }}" itemprop="url" href="/san-pham/{{ $name->slug.'.html' }}" title="{{ $name->title }}"><span itemprop="title">{{ $name->name }}</span></a>
            <span><i class="fa fa-angle-right"></i></span>
          </li>
          @endforeach --}}
                        <li><strong><span itemprop="title">{{ $product->name }}</span></strong>
                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="product" itemscope itemtype="http://schema.org/Product">
        <meta itemprop="url" content="{{ URL::current() }}">
        <meta itemprop="image" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $product->img }}">
        <meta itemprop="description" content="{{ $product->descriptions }}">
        <meta itemprop="name" content="{{ $product->name }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-8 details-product">
                    <div class="product-bottom">
                        <div class=" row clearfix padding-bottom-10">
                            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
                                <div>
                                    <div class="app-figure" id="zoom-fig">
                                        <a id="Zoom-1" class="MagicZoom Active" title="{{ $product->name }}"
                                            href="/storage/uploads/{{ $product->img }}">
                                            <img src="{{imageUrl('/storage/uploads/'.$product->img, '600', '600', '100', '1')}}"
                                                alt="{{ $product->name }}" class="img-fluid w-100 h-100"/>
                                        </a>
                                        <div class="selectors mt-3" style="margin-top: 4px;">
                                            <a data-zoom-id="Zoom-1" href="/storage/uploads/{{ $product->img }}"
                                                data-image="/storage/uploads/{{ $product->img }}">
                                                @php
                                                    $img = $product->img;
                                                @endphp
                                                <img srcset="/storage/uploads/{{ $product->img }}?scale.width=112 8x"
                                                    width="93"
                                                    src="{{ imageUrl('/storage/uploads/' . $img, '93', '93', '100', '1') }}"
                                                    alt="{{ $product->name }}" class="img-fluid w-100 h-100"/>
                                            </a>
                                            @foreach ($images as $image)
                                                <a data-zoom-id="Zoom-1" href="/storage/products/{{ $image->imgs }}"
                                                    data-image="/storage/products/{{ $image->imgs }}">
                                                    @php
                                                        $img = $image->imgs;
                                                    @endphp
                                                    <img srcset="/storage/products/{{ $image->imgs }}?scale.width=112 8x"
                                                        src="{{ imageUrl('/storage/products/' . $img, '93', '93', '100', '1') }}"
                                                        width="93" height="auto" alt="{{ $product->name }}" class="img-fluid w-100 h-100"/>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 details-pro">
                                <div class="product-top clearfix">
                                    <h1 class="title-head">{{ $product->name }}</h1>
                                </div>
                                @if (isset($product->product_code))
                                    <div class="product-code">
                                        <b>Mã sản phẩm:</b> {{ $product->product_code }}
                                    </div>
                                @endif
                                @if ($product->price > 0)
                                    <div class="price-box clearfix" itemscope itemtype="http://schema.org/Offer">
                                        <div class="special-price"><strong>Giá:</strong> <span
                                                class="price product-price {{ $product->discount > 0 ? 'selling_price' : '' }}">
                                                {{ product_price_view($product->price) }}₫ </span> </div>
                                    </div>
                                @endif
                                @if (!$product->discount == 0)
                                    <div class="price-box clearfix" itemscope itemtype="http://schema.org/Offer">
                                        <div class="special-price"><strong>Giá khuyến mãi: </strong><span
                                                class="price product-price">
                                                {{ product_price_view($product->selling_price) }}₫ </span> </div>
                                    </div>
                                @elseif($product->discount == 0 && $product->price == 0 && $product->selling_price == 0)
                                    <div class="price-box clearfix" itemscope itemtype="http://schema.org/Offer">
                                        <div class="special-price"><span class="price product-price">Giá: Liên hệ </span>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->discount > 0)
                                    <div class="price-box clearfix" itemscope itemtype="http://schema.org/Offer">
                                        <div class="special-price"><strong>Giảm giá: </strong><span
                                                class="price product-price">{{ $product->discount }}% </span> </div>
                                    </div>
                                @endif
                                
                                <div class="inventory_quantity" itemscope itemtype="http://schema.org/ItemAvailability">
                                    <span class="stock-brand-title"><strong>Tình trạng:</strong></span>
                                    <span class="a-stock" itemprop="supersededBy">Còn hàng</span>
                                </div>
                                <div class="product-summary product_description margin-bottom-15 margin-top-15">
                                    <div class="rte description">
                                        {!! $product->descriptions !!}
                                    </div>
                                </div>
                                <b>Số lượng</b>
                                <form action="{{ route('order.now.quantity') }}" method="POST" class="form-group mb-2">
                                    @csrf
                                    <input type="hidden" name="recaptcha" id="recaptcha">
                                    <input type="number" name="qty" min="1" max="10" value="1"
                                        class="form-control">
                                    <input type="hidden" name="product" value="{{ $product->id }}" class="form-control">
                                    <input type="hidden" name="productid_hidden" value="{{ $product->id }}">
                                    <br>
                                    <button type="submit" class="btn btn-lg btn-danger" name="buy_now" value="1"
                                        title="Mua ngay">Mua ngay</button>
                                    <button type="submit" class="btn btn-lg btn-info" name="buy_add_to_cart"
                                        value="0" title="Thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
                                </form>
                                <div class="phone_contact_product">
                                    <div class="phone_contact_product__title">Để lại số điện thoại</div>
                                    <div class="phone_contact_product__sub_title">Chúng tôi sẽ gọi tư vấn cho bạn Miễn Phí</div>
                                    <div class="phone_contact_product__input_group">
                                        <input type="text" placeholder="Số điện thoại">
                                        <button type="submit">Gửi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top-10">
                        <div class="col-md-12">
                            <div class="product-tab e-tabs padding-bottom-10">
                                <div class="text-center border-ghghg margin-bottom-20">
                                    <ul class="tabs tabs-title clearfix">
                                        <li class="tab-link" data-tab="tab-1">
                                            <h3><span>Chi tiết sản phẩm</span></h3>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ba-text-fpt" id="fancy-image-view">      
                                    {!! $product->content !!}
                                </div>
                                {{-- <div id="tab-1" class="tab-content">
                                    <div class="rte">
                                        <div class="product-well">
                                            <div class="ba-text-fpt" id="fancy-image-view">
                                                
                                            </div>
                                            <div class="show-more">
                                                <a class="btn btn-default btn--view-more">
                                                    <span class="more-text">Xem thêm <i
                                                            class="fa fa-chevron-down"></i></span>
                                                    <span class="less-text">Thu gọn <i
                                                            class="fa fa-chevron-up"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="waiting_for_fix">
            <div class="row margin-top-20">
                <div class="col-lg-12">
                    <div class="related-product">
                        <div class="home-title">
                            <h2>Sản phẩm cùng loại</h2>
                        </div>
                        <div class="section-tour-owl owl-carousel not-dqowl products-view-grid" data-md-items="5"
                            data-sm-items="4" data-xs-items="2" data-margin="10">
                            @foreach ($product_relationship as $pro_re)
                                <div class="product-item">
                                    <div class="product-item-container grid-view-item">
                                        <div class="left-block">
                                            <div class="product-image-container product-image">
                                                <a class="grid-view-item__link image-ajax"
                                                    href="{{ route('frontend.home.index') }}/{{ $pro_re['slug'] . '.html' }}">
                                                    @php
                                                        $img = $pro_re['img'];
                                                    @endphp
                                                    <img class="first-img img-responsive center-block"
                                                        src="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                        data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '222', '222', '100', '1') }}"
                                                        alt="{{ $pro_re['name'] }}" />
                                                </a>
                                            </div>
                                            <div class="button-link">
                                                <div class="btn-button add-to-cart action  ">
                                                    <form action="" method="post" class="variants form-nut-grid"
                                                        data-id="" enctype="multipart/form-data">
                                                        <button
                                                            class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to"
                                                            title="Chi tiết" type="button"
                                                            onclick="window.location.href='/{{ $pro_re['slug'] . '.html' }}'">
                                                            <i class="ion ion-md-redo"></i> Chi tiết
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="quickview-button">
                                                    <a class="visible-lg btn_df" title="Xem nhanh">
                                                        <i class="ion ion-md-search quickviewproduct"
                                                            data-slug="{{ $pro_re['slug'] }}"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4 class="title-product">
                                                    <a class="product-name line-clamp"
                                                        href="{{ route('frontend.home.index') }}/{{ $pro_re['slug'] . '.html' }}"
                                                        title="{{ $pro_re['title'] }}">{{ $pro_re['name'] }}</a>
                                                </h4>
                                                @if ($pro_re['discount'] == 0 && $pro_re['price'] > 0)
                                                    <div class="price">
                                                        <span class="price-new">
                                                            <span
                                                                class="money">{{ product_price_view($pro_re['price']) }}₫</span>
                                                        </span>
                                                    </div>
                                                @elseif($pro_re['discount'] > 0)
                                                    <div class="price">
                                                        <span class="price-old">
                                                            <span
                                                                class="money">{{ product_price_view($pro_re['price']) }}₫</span>
                                                        </span>
                                                        <span class="price-new">
                                                            <span
                                                                class="money">{{ product_price_view($pro_re['selling_price']) }}₫</span>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('style')
@endpush

@push('script')
    <script type="application/ld+json">{"@context":"https://schema.org/","@type":"Product","name":"{{ $product->name }}","image":["{{ route('frontend.home.index') }}/storage/uploads/{{ $product->img }}",@foreach($images as $image)
"{{ route('frontend.home.index') }}/storage/uploads/{{ $image->imgs }}",@endforeach],"description":"{{ $product->description }}","sku":"{{ $product->product_code }}","mpn":"{{ $product->id }}","brand":{"@type":"Brand","name":"Menu"},"review":{"@type":"Review","reviewRating":{"@type":"Rating","ratingValue":"5","bestRating":"5"},"author":{"@type":"Person","name":"{{ $setting->nameindex }}"}},"aggregateRating":{"@type":"AggregateRating","ratingValue":"5.0","reviewCount":"6"},"offers":{"@type":"Offer","url":"{{ URL::current() }}","priceCurrency":"VND","price":"{{ $product->selling_price }}","priceValidUntil":"2020-12-31","itemCondition":"https://schema.org/UsedCondition","availability":"https://schema.org/InStock","seller":{"@type":"Organization","name":"{{ $setting->nameindex }}"}}}</script>
@endpush
