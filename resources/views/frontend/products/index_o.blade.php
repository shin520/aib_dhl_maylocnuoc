@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <nav aria-label="breadcrumb" style="margin-top: 46px">
    <ol class="breadcrumb shadow-sm">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title=""><i class="ti-home"></i> Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="{{ route('frontend.cat') }}" title="Menu">Menu</a></li>
      @foreach($allDataBreadCrumb as $name)
      <li class="breadcrumb-item {{ ($loop->last) ? 'active' : '' }}" aria-current="page"><a href="/menu/{{ $name->slug.'.html' }}" title="">{{ $name->name }}</a></li>
      @endforeach
      <li class="breadcrumb-item"><a href="{{ URL::current() }}" title="{{ $product->name }}">{{ $product->name }}</a></li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
      <article class="card shadow post">
        <div>
          <div id="post_content">
            <div class="main-title text-center mt-3">
              <h1 class="title">
              <a href="{{ URL::current() }}" title="{{ $product->name }}" style="font-weight: bold;">{{ $product->name }}</a>
              </h1>
            </div>
            <h2 style="position:absolute; top:-1000px;">{{ $product->name }}</h2>
            <h3 style="position:absolute; top:-1000px;">{{ $product->name }}</h3>
            <div class="container">
              <hr>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
                  <div>
                    <div class="app-figure" id="zoom-fig">
                      <a id="Zoom-1" class="MagicZoom Active" title="{{ $product->name }}"
                        href="/storage/uploads/{{ $product->img }}">
                        <img src="/storage/uploads/{{ $product->img }}?scale.height=400" alt=""/>
                      </a>
                      <div class="selectors mt-3">
                        <a data-zoom-id="Zoom-1" href="/storage/uploads/{{ $product->img }}" data-image="/storage/uploads/{{ $product->img }}?scale.height=400">
                          @php
                          $img = $product->img;
                          @endphp
                          <img srcset="/storage/uploads/{{ $product->img }}?scale.width=112 8x" width="108" src="{{ imageUrl('/storage/uploads/'.$img,'108','108','100','1') }}"/>
                        </a>
                        @foreach($images as $image)
                        <a data-zoom-id="Zoom-1" href="/storage/products/{{ $image->imgs }}" data-image="/storage/products/{{ $image->imgs }}?scale.height=400">
                          @php
                          $img = $image->imgs;
                          @endphp
                          <img srcset="/storage/products/{{ $image->imgs }}?scale.width=112 8x" src="{{ imageUrl('/storage/products/'.$img,'108','108','100','1') }}" width="108" height="auto" />
                        </a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div id="code-to-copy"></div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  @if (Session::has('success'))
                  <div class="alert alert-success">{{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <a href="{{ route('order.view') }}" title="Xem giỏ hàng"><u>Xem giỏ hàng !</u></a>
                  </div>
                  @endif
                  @if(isset($product->product_code))
                  <div class="product-code">
                    <b>Mã sản phẩm:</b> {{ $product->product_code }}
                  </div>
                  @endif
                  @if($product->price > 0)
                  <div class="product__buy">
                    <div class="product__prices">
                      Giá: <span style="font-size: 26px;">{{ product_price_view($product->price) }}₫</span>
                    </div>
                  </div>
                  @endif
                  @if(!$product->discount == 0)
                  <div class="product__buy">
                    <div class="product__prices">
                      Giá khuyến mãi: <span style="font-size: 26px;color:#dc3545">{{ product_price_view($product->selling_price) }}₫</span>
                    </div>
                  </div>
                  @elseif($product->discount == 0 && $product->price == 0 && $product->selling_price == 0)
                  <div class="product__buy">
                    <div class="product__prices">
                      Giá: <span style="font-size: 26px;color:#dc3545">Liên hệ</span>
                    </div>
                  </div>
                  @endif
                  @if($product->discount > 0)
                  <div class="product__buy">
                    <div class="product__prices">
                      Giảm giá: <span style="font-size: 26px;color:#dc3545">{{ $product->discount }} %</span>
                    </div>
                  </div>
                  @endif
                  <div class="product-description mb-2">
                    {{ $product->descriptions }}
                  </div>
                  <b>Số lượng</b>
                  <form action="{{ route('order.now.quantity') }}" method="POST" class="form-group mb-2" >
                    @csrf
                    <input type="number" name="qty" min="1" max="10" value="1" class="form-control">
                    <input type="hidden" name="product" value="{{ $product->id }}" class="form-control">
                    <input type="hidden" name="productid_hidden" value="{{ $product->id }}">
                    <br>
                    <button type="submit" class="btn btn-success btn-custom btn-order" name="buy_now" value="1" title="Đặt món">Đặt món</button>
                    <button type="submit" class="btn btn-success btn-custom" name="buy_add_to_cart" value="0" title="Thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
                  </form>
                </div>
              </form>
              <div class="col-12 mb-4">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Giới thiệu món ăn</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">{!! $product->content !!}</div>
                </div>
              </div>
              <div class="col-12 mb-4">
                <div class="main-title text-center">
                  <h1 class="title" >
                  <a href="{{ URL::current() }}" title="Sản phẩm cùng danh mục" style="font-weight: bold;">Có thể bạn thích</a>
                  </h1>
                </div>
                <div class="row">
                  @foreach($product_relationship as $pro_re)
                  <div class="col-6 col-xs-6 col-sm-6 col-md-3 mb-4">
                    <div class="card">
                      <div class="img-hover-zoom">
                        @php
                        $img = $pro_re['img'];
                        @endphp
                        <a href="{{ route('frontend.home.index') }}/{{ $pro_re['slug'].'.html' }}">
                          <img class="card-img-top" src="{{ imageUrl('/storage/uploads/'.$img,'250','250','100','1') }}" alt="{{ $pro_re["name"] }}">
                        </a>
                      </div>
                      <div class="card-body">
                        <h5 class="{{-- card-title --}} text-center"><a href="{{ route('frontend.home.index') }}/{{ $pro_re['slug'].'.html' }}" title="">{{ $pro_re['name'] }}</a></h5>
                        <p class="card-price text-center">
                          @if($pro_re['discount'] == 0 && $pro_re['price'] > 0)
                          {{ product_price_view($pro_re['price']) }}₫
                          @elseif($pro_re['discount'] > 0)
                          <span style="text-decoration: line-through; color: #999; font-size: 16px;">{{ product_price_view($pro_re['price']) }}₫</span>
                          {{ product_price_view($pro_re['selling_price']) }}₫
                          @else
                          {{ "Liên hệ" }}
                          @endif
                        </p>
                        <a href="{{ route('order.add',$pro_re['id']) }}" class="col text-center btn btn-danger btn-custom btn-order mb-3" title="Đặt món"><i class="ti ti-new-window"></i> Đặt món</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
  @endsection
  @push("style")

  @endpush
  @push("script")
  <script src="/frontend/bower_components/lightbox2/dist/js/lightbox.min.js"></script>
  <script>
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
  $(this).ekkoLightbox({ wrapping: false });
  });
  </script>
  <script>
  // $('img').click(function () {
  //     var alt = $(this).attr("alt")
  //     // alert(alt);
  // });
  $(function(){
  $("a img").each(function(){
  $(this).attr("title", $(this).find("img").attr("alt"));
  });
  });
  $('#post_content img').addClass('img-fluid');
  $('#post_content').addClass('photos');
  $('#post_content figure a').attr('data-lightbox', 'photos');
  // $('#post_content figure a').attr('title', '');
  // $('#post_content figure a img').attr('title', '');
  // $('#post_content figure a img').attr('alt', '{{ $product->name }}');
  $('#post_content p a').attr('data-lightbox', 'photos');
  // $('#post_content p a').attr('title', '');
  // $('#post_content p a img').attr('title', '');
  // $('#post_content p a img').attr('alt', '{{ $product->name }}');
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "image": [
      "{{ route('frontend.home.index') }}/storage/uploads/{{ $product->img }}",
      @foreach($images as $image)
        "{{ route('frontend.home.index') }}/storage/uploads/{{ $image->imgs }}",
      @endforeach
     ],
    "description": "{{ $product->description }}",
    "sku": "{{ $product->product_code }}",
    "mpn": "{{ $product->id }}",
    "brand": {
      "@type": "Brand",
      "name": "Menu"
    },
    "review": {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5",
        "bestRating": "5"
      },
      "author": {
        "@type": "Person",
        "name": "Madam Saigon"
      }
    },
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "5.0",
      "reviewCount": "6"
    },
    "offers": {
      "@type": "Offer",
      "url": "{{ URL::current() }}",
      "priceCurrency": "VND",
      "price": "{{ $product->selling_price }}",
      "priceValidUntil": "2020-12-31",
      "itemCondition": "https://schema.org/UsedCondition",
      "availability": "https://schema.org/InStock",
      "seller": {
        "@type": "Organization",
        "name": "Madam Saigon"
      }
    }
  }
  </script>
  @endpush