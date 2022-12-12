@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <nav aria-label="breadcrumb" style="margin-top: 46px">
    <ol class="breadcrumb shadow-sm">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="{{ route('frontend.cat') }}" title="Menu">Menu</a></li>
      {{-- <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="{{ $category->name }}">{{ $category->name }}</a></li> --}}
    </ol>
  </nav>
  <div class="row">
    @foreach($all_products as $product)
    <div class="col-6 col-xs-6 col-sm-6 col-md-3 mb-4">
    <div class="card">
      <div class="img-hover-zoom">
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
<nav style="margin: 0 auto;padding-bottom: 40px;">
  <ul class="pagination justify-content-center">
    {{ $all_products->links('vendor.pagination.bootstrap-4') }}
  </ul>
</nav>
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
$('#post_content img').addClass('img-fluid');
$('#post_content').addClass('photos');
$('#post_content figure a').attr('data-lightbox', 'photos');
$('#post_content figure a').attr('title', '{{ $abouts->title }}');
$('#post_content figure a img').attr('title', '{{ $abouts->title }}');
$('#post_content figure a img').attr('alt', '{{ $abouts->name }}');
$('#post_content p a').attr('data-lightbox', 'photos');
$('#post_content p a').attr('title', '{{ $abouts->title }}');
$('#post_content p a img').attr('title', '{{ $abouts->title }}');
$('#post_content p a img').attr('alt', '{{ $abouts->name }}');
</script>
@endpush