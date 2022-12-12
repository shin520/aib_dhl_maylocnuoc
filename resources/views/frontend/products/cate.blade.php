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
                        <li>
                            <strong><span itemprop="title"><a href="/san-pham.html">Sản phẩm</a></span></strong>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        @if (!is_null($procate))
                            <li>
                                <strong><span itemprop="title"><a
                                            href="/san-pham/{{ $procate->slug . '.html' }}">{{ $procate->name ?? '' }}</a></span></strong>
                                <span>
                                    @if (!is_null($procattwo))
                                        <i class="fa fa-angle-right"></i>
                                    @endif
                                </span>
                            </li>
                        @endif

                        @if (!is_null($procattwo))
                            <li>
                                <strong><span itemprop="title"><a
                                            href="/san-pham/{{ $procattwo->slug . '.html' }}">{{ $procattwo->name ?? '' }}</a></span></strong>
                                {{-- <span>
              @if (!is_null($procatthree))
              <i class="fa fa-angle-right"></i>
              @endif
            </span> --}}
                            </li>
                        @endif
                        {{-- @if (!is_null($procatthree))
          <li><strong><span itemprop="title">{{ $procatthree->name ?? '' }}</span></strong>
            <span></span>
          </li>
          @endif --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="hidden">
  <aside class="aside-item collection-category margin-bottom-10">
    <div class="aside-title">
      <h3 class="title-head margin-top-0"><span>Danh mục</span></h3>
    </div>
    <div class="aside-content">
      <nav class="nav-category navbar-toggleable-md">
        <ul class="nav navbar-pills">
          @php
          $procatones = DB::table('procatones')->get();
          @endphp
          @forelse($procatones as $procatone)
          <li class="nav-item ">
            <a href="{{ route('frontend.home.index') }}/san-pham/{{ $procatone->slug.'.html' }}" class="nav-link">{{ $procatone->name }}</a>
            <i class="fa fa-angle-down"></i>
            <ul class="dropdown-menu">
            </ul>
          </li>
          @empty
            ''
          @endforelse
        </ul>
      </nav>
    </div>
  </aside>
</div> --}}
    <div class="container margin-top-20">
        <div class="row">
            <div class="col-md-12">
                <div class="category-gallery margin-bottom-20">
                    <div class="image pd-bt30">
                        <img src="{{ imageUrl('/storage/uploads/' . $setting->banner_index, '1300', '350', '100', '1') }}" data-lazyload="{{ imageUrl('/storage/uploads/' . $setting->banner_index, '1300', '350', '100', '1') }}" alt="Tất cả sản phẩm"
                            class="img-responsive center-block" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container margin-bottom-20">
        <div class="row">
            <section class="main_container collection col-md-12 col-sm-12 col-xs-12">
                <div class="pottion">
                    <h1 class="title-head margin-top-0 hidden">Tất cả sản phẩm {{ $procate->name ?? '' }}</h1>
                    <div class="category-products products clearfix">
                        <section class="products-view products-view-grid">
                            <div class="clearfix borderss row">
                                @forelse($pros ?? array() as $product)
                                    <div class="col-md-3 col-6">
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
                                                                src="{{ imageUrl('/storage/uploads/' . $img, '250', '250', '100', '1') }}"
                                                                data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '250', '250', '100', '1') }}"
                                                                alt="{{ $product->name }}" />
                                                        </a>
                                                    </div>
                                                    <div class="button-link">
                                                        <div class="btn-button add-to-cart action  ">
                                                            <form action="" method="post"
                                                                class="variants form-nut-grid" data-id=""
                                                                enctype="multipart/form-data">
                                                                <button
                                                                    class="btn_df tt-btn-addtocart btn-cart btn btn-gray left-to"
                                                                    title="Chi tiết" type="button"
                                                                    onclick="window.location.href='{{ route('frontend.home.index') }}/{{ $product->slug . '.html' }}'"
                                                                    @php
$img = $product->img; @endphp>
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
                                @empty
                                    <div class="alert alert-danger">Sản phẩm đang cập nhật</div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
@endpush
