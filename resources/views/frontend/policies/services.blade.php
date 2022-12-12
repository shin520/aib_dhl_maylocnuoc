@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 main-content">
            <nav aria-label="breadcrumb" style="margin-top: 10px">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item">Dịch vụ</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="{{ $newcategory->name }}">{{ $newcategory->name }}</a>
                    </li> --}}
                </ol>
            </nav>
            <div class="main-title">
                <h1 class="heading text-center" style="color:#222222"><a href="{{ URL::current() }}" title="Dịch vụ">Dịch vụ</a></h1>
            </div>
            {{-- @php
            if (!$newcategory->posts->count()){
            echo "<p class='text-danger text-center'>Nội dung đang cập nhật...</p>";
            }
            @endphp --}}
            <div class="row">
                @foreach($servis as $servi)
                <div class="col-md-4">
                  <figure>
                    @php
                     $img = $servi->img;
                    @endphp
                    <div class="thumbnail-news mb-2">
                      <a href="{{ route('frontend.home.index') }}/dich-vu/{{ $servi->slug.'.html' }}">
                        <img src="{{ imageUrl('/storage/uploads/'.$img,'370','185','100','1') }}" class="img-fluid" alt="{{ $servi->name }}" title="{{ $servi->name }}">
                      </a>
                    </div>
                    <figcaption>
                    <div class="time-author">
                      <span><i class="ti ti-time"></i> {{ date("d/m/Y", strtotime($servi->updated_at)) }}</span><span><i class="ti ti-pencil ml-3"></i> Địa ốc Phúc Long</span><span><i class="ti ti-eye ml-3"></i> {{ $servi->view_count }}</span>
                    </div>
                    <div class="title__news">
                      <h3><a href="{{ route('frontend.home.index') }}/dich-vu/{{ $servi->slug.'.html' }}">{{ $servi->name }}</a></h3>
                    </div>
                    <div class="des_news">
                      <p>{!! $servi->descriptions !!}</p>
                    </div>
                    </figcaption>
                  </figure>
                </div>
                @endforeach
              </div>
              
        </div>
        {{-- <nav>
            <ul class="pagination justify-content-center mb-4">
                {{$servis->links('vendor.pagination.bootstrap-4')}}
            </ul>
        </nav> --}}
    </div>
</div>
@endsection
@push("style")
@endpush
@push("script")
<script>
    $(document).ready(function(){
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
</script>
{{-- <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":["CollectionPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $newcategory->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"description":"{{ $newcategory->descriptions }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $newcategory->name }}"}}]}]}</script> --}}
@endpush