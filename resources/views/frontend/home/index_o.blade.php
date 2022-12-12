@extends("frontend.layout.master-layout")
@section("content")
@include('frontend.layout.slider')
<div class="container mb-5">
  <h1 style="position:absolute; top:-999px;">{{ $setting->nameindex }}</h1>
  <div class="row">
    <div class="col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"><img src="/storage/uploads/{{ $abouts->img }}" class="img-fluid" alt="{{ $abouts->title }}"></div>
    <div class="col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <div class="text-center madam-saigon">
        <span class="madam">MADAM</span> <span class="saigon">SàiGòn</span> 
      </div>
      @php
        $about = Str::limit($abouts->content, 1060, ' (...)');
      @endphp
      {!! $about !!}
      <div>
        <a href="{{ route('frontend.about.index') }}" class="btn btn-danger btn-custom btn-order">Xem thêm</a>
      </div>
    </div>
  </div>
</div>
</div>
<div class="service-basic-wrap website-wrap-bg" style="border-top: 2px solid #fd4205;padding-top: 0px;padding-bottom:52px">
  {{-- @include("frontend.layout.product") --}}
<div class="main-title-box mx-auto menu-color title-index-why"><h2 style="display: inline;font-size:18px">MÓN ĂN YÊU THÍCH</h2></div>
<div class="container">
  <div class="row">
  {{-- <div class="col text-center title-index-why">
    <h2 class="btn btn-danger btn-custom">MÓN ĂN YÊU THÍCH</h2>
  </div> --}}
  </div>
  <div class="row">
    @foreach($products as $product)
    <div class="col-6 col-xs-6 col-sm-6 col-md-3 mb-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
    <div class="card">
      <div class="img-hover-zoom">
         {{-- <a href="{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}"><img class="card-img-top" src="/storage/uploads/{{ $product->img }}" alt="{{ $product->title }}"></a> --}}
         @php
          $img = $product->img;
         @endphp
         <a href="{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}">
          <img class="card-img-top" src="{{ imageUrl('/storage/uploads/'.$img,'250','250','100','1') }}" alt="{{ $product->title }}">
         </a>
      </div>
      <div class="card-body">
        <h5 class="{{-- card-title --}} text-center"><a href="{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}" title="">{{ $product->name }}</a></h5>
        <p class="card-price text-center">
          @if($product->discount == 0 && $product->price > 0)
            {{ product_price_view($product->price) }}₫
          @elseif($product->discount > 0)
            <span style="text-decoration: line-through; color: #999; font-size: 16px;">{{ product_price_view($product->price) }}₫</span>
            {{ product_price_view($product->selling_price) }}₫
          @else
            {{ "Liên hệ" }}
          @endif
        </p>
        <a href="{{ route('order.now',$product->id) }}" class="col text-center btn btn-danger btn-custom btn-order mb-3" title="Đặt món"><i class="ti ti-new-window"></i> Đặt món</a>
      </div>
    </div>
    </div>
    @endforeach
  </div>
    <nav class="" style="margin: 0 auto;">
      <ul class="pagination justify-content-center">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
      </ul>
    </nav>
</div>
</div>
<div class="service-basic-wrap mb-3" style="border-top: 2px solid #fd4205;">
  <div class="main-title-box mx-auto menu-color title-index-why" style="top: -24px;z-index: 9;"><h2 style="display: inline;font-size:18px">TIN TỨC</h2></div>
<div class="region-wrap">
  <div class="container">
    {{-- <div class="title-index-why">
      <h2 class="text-center">TIN TỨC</h2>
    </div> --}}

    <div class="swiper-container-news" style="overflow: hidden;">
      <div class="swiper-wrapper">
        @foreach($posts as $post)
          <div class="swiper-slide" style="background:none">
            <figure class="clearfix">
              <div class="row">
                <div class="col-md-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                  <figure>
                    @php
                     $img = $post->img;
                    @endphp
                    <div class="thumbnail-news mb-2">
                      <a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}">
                        <img src="{{ imageUrl('/storage/uploads/'.$img,'370','185','100','1') }}" class="img-fluid" alt="{{ $post->name }}" title="{{ $post->name }}">
                      </a>
                    </div>
                    <figcaption>
                    <div class="time-author">
                      <span><i class="ti ti-time"></i> {{ date("d/m/Y", strtotime($post->updated_at)) }}</span><span><i class="ti ti-pencil ml-3"></i> Madam Saigon</span><span><i class="ti ti-eye ml-3"></i> {{ $post->view_count }}</span>
                    </div>
                    <div class="title-madamsaigon">
                      <h3><a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}">{{ $post->name }}</a></h3>
                    </div>
                    <div class="descriptions-news">
                      <p>{!! $post->descriptions !!}</p>
                    </div>
                    </figcaption>
                  </figure>
                </div>
              </div>
            </figure>
          </div>
        @endforeach
      </div>
    </div>
    {{-- <div class="row">
      @foreach($posts as $post)
      <div class="col-md-4">
        <figure>
          <div class="thumbnail-why">
            <img src="/storage/uploads/{{ $post->img }}" class="img-fluid" alt="{{ $post->name }}" title="{{ $post->name }}">
          </div>
          <figcaption>
          <span><i class="ti ti-time"></i> 06/06/2020</span><span><i class="ti ti-pencil ml-3"></i>Admin</span>
          <div class="title-madamsaigon">
            <h3>{{ $post->name }}</h3>
          </div>
          <div class="descriptions-why">
            {!! $post->descriptions !!}
          </div>
          </figcaption>
        </figure>
      </div>
      @endforeach
    </div> --}}
  </div>
</div>
</div>
@include('frontend.layout.video')
<div class="service-basic-wrap">
  <div class="main-title-box mx-auto menu-color title-index-why" style="top:-24px;z-index: 9;"><h2 style="display: inline;font-size:18px">CẢM NHẬN KHÁCH HÀNG</h2></div>
  <div class="container">
<div class="container">
  {{-- <div class="mx-auto font-weight-bold">
    <div class="title-index-cus">
      <h2 class="text-center">Cảm nhận khách hàng</h2>
    </div>
  </div>
  <hr> --}}
  <div class="swiper-container-cus" style="overflow: hidden;">
    <div class="swiper-wrapper">
      @foreach($customers as $customer)
      @if($customer->type == 'customer')
        <div class="swiper-slide" style="background:none">
          <figure class="clearfix">
            <div class="row">
              <div class="col-md-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                @php
                  $img = $customer->img
                @endphp
                <div class="thumbnail">
                  <img src="{{ imageUrl('/storage/uploads/'.$img,'62','62','100','1') }}" alt="{{ $customer->name }}" title="{{ $customer->name }}">
                </div>
                <figcaption>
                <blockquote>
                  <div class="cus-review">
                    {!! $customer->descriptions !!}
                    <div><img src="/images/five-star.png" style="width: 110px;height: auto;" alt=""></div>
                    <div class="text-center">
                      <p>{{ $customer->name }} - <i>{{ $customer->work }}</i></p>
                    </div>
                  </div>
                </blockquote>
                </figcaption>
              </div>
            </div>
          </figure>
        </div>
      @endif
      @endforeach
    </div>
  </div>
</div>
</div>
{{-- <div class="cont">
  <div class="page-head">
    <div class="demo-gallery">
      <div class="row no-gutters" id="lightgallery">
        <div class="col-md-2" data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/2-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/2-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/2.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
          data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/2-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/2-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/2.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/2-1600.jpg"
          data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
          data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
          data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="" data-src="https://sachinchoolur.github.io/lightGallery/static/img/1-1600.jpg"
          data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/13-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/13-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/13.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg"
          data-sub-html="<h4>Sunset Serenity</h4><p>A gorgeous Sunset tonight captured at Coniston Water....</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/13-1600.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
        <div class="col-md-2" data-responsive="https://sachinchoolur.github.io/lightGallery/static/img/4-375.jpg 375, https://sachinchoolur.github.io/lightGallery/static/img/4-480.jpg 480, https://sachinchoolur.github.io/lightGallery/static/img/4.jpg 800" data-src="https://sachinchoolur.github.io/lightGallery/static/img/4-1600.jpg"
          data-sub-html="<h4>Coniston Calmness</h4><p>Beautiful morning</p>" data-pinterest-text="Pin it" data-tweet-text="share on twitter ">
          <a href="">
            <img class="img-responsive" src="https://sachinchoolur.github.io/lightGallery/static/img/thumb-4.jpg">
            <div class="demo-gallery-poster">
              <img src="/images/zoom.png">
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div> --}}
{{-- <div class="row no-gutters" id="aniimated-thumbnials">
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
  <div class="col-md-2">
   <a data-src="https://picsum.photos/800/600">
    <img class="img-fluid item" src="https://picsum.photos/800/600" />
  </a>
  </div>
</div> --}}
@endsection
@push("style")
@endpush
@push("script")
<script>
    $(document).ready(function() {
      $(".owl-carousel").owlCarousel( {
          autoplay: true, dots: true, loop: true, margin: 30, navigation: true, pagination: true, lazyLoad: true, singleItem: true, responsive: {
              0: {
                  items: 1
              }
              , 768: {
                  items: 1
              }
              , 900: {
                  items: 2
              }
          }
      }
      );
  }
  );
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
{{-- <script>
  var input = document.getElementById("q");
  input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("submit").click();
    }
  });
</script> --}}
<script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}/#organization","name":"{{ $setting->nameindex }}","url":"{{ $setting->website }}/","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}/#logo","inLanguage":"{{ $setting->locale }}","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}/#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}/#website","url":"{{ route('frontend.home.index') }}/","name":"{{ $setting->nameindex }}","inLanguage":"{{ $setting->locale }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}/#organization"}},{"@type":["WebPage"],"@id":"{{ route('frontend.home.index') }}/#webpage","url":"{{ route('frontend.home.index') }}/","name":"{{ $setting->nameindex }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}/#website"},"inLanguage":"{{ $setting->locale }}","about":{"@id":"{{ route('frontend.home.index') }}/#organization"},"datePublished":"2019-06-06T08:20:25+00:00","dateModified":"2020-02-01T10:26:32+00:00","description":"{{ $setting->description }}"}]}</script>
@endpush