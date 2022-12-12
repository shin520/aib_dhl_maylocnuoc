@extends("frontend.layout.master-layout")
@section("content")
<section class="bread-crumb margin-bottom-10">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <li class="home">
                        <a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                        <span><i class="fa fa-angle-right"></i></span>
                    </li>
                    <li><strong itemprop="title">Kết quả tìm kiếm</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
@if(count($products) > 0)
<div class="col-md-12">
    <h1 class="title-head text-center margin-bottom-10">Có {{ $products->count() }} kết quả tìm kiếm phù hợp</h1>
</div>
@else
<section class="signup search-main collections-container margin-bottom-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-head text-center margin-bottom-10">Không tìm thấy bất kỳ kết quả nào với từ khóa trên.</h1>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center margin-bottom-10">Vui lòng nhập từ khóa tìm kiếm khác</div>
                <form action="{{ route('search.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Nhập tên sản phẩm ?" />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif
<section class="signup search-main collections-container margin-bottom-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="products-view-grid products">
                    <div class="clearfix borderss">
                        @foreach ($products as $product)
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-15">
                            <div class="product-item">
                                <div class="product-item-container grid-view-item">
                                    <div class="left-block">
                                        <div class="product-image-container product-image">
                                            <a class="grid-view-item__link image-ajax" href="{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}">
                                                @php
                                                $img = $product->img;
                                                @endphp
                                                <img class="first-img img-responsive center-block" src="{{ imageUrl('/storage/uploads/'.$img,'210','210','100','1') }}" data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'210','210','100','1') }}" alt="{{ $product->name }}" />
                                            </a>
                                        </div>
                                        <div class="button-link">
                                            <div class="btn-button add-to-cart action  ">
                                                <form action="" method="post" class="variants form-nut-grid" data-id="" enctype="multipart/form-data">
                                                    <button class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to" title="Chi tiết" type="button" onclick="window.location.href='/{{ $product->slug.'.html' }}'" >
                                                    <i class="ion ion-md-redo"></i> Chi tiết
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="quickview-button">
                                                <a class="visible-lg btn_df" title="Xem nhanh">
                                                    <i class="ion ion-md-search quickviewproduct" data-slug="{{ $product->slug }}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4 class="title-product">
                                            <a class="product-name line-clamp" href="{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}" title="{{ $product->title }}">{{ $product->name }}</a>
                                            </h4>
                                            @if($product->discount == 0 && $product->price > 0)
                                            <div class="price">
                                                <span class="price-new">
                                                    <span class="money">{{ product_price_view($product->price) }}₫</span>
                                                </span>
                                            </div>
                                            @elseif($product->discount > 0)
                                            <div class="price">
                                                <span class="price-old">
                                                    <span class="money">{{ product_price_view($product->price) }}₫</span>
                                                </span>
                                                <span class="price-new">
                                                    <span class="money">{{ product_price_view($product->selling_price) }}₫</span>
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
</section>
@endsection

@push("style")
@endpush

@push("script")
@endpush