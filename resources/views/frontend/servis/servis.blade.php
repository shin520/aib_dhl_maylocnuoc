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
                        <li><strong itemprop="title">Dịch vụ</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container" itemscope itemtype="http://schema.org/Blog">
        <meta itemprop="name" content="Dịch vụ">
        <meta itemprop="description" content="Tất cả Dịch vụ">
        <div class="row">
            <section class="right-content col-md-12 col-md-push-3 list-blog-page">
                <div class="box-heading hidden">
                    <h1 class="title-head text-center">Dịch Vụ</h1>
                </div>
                <section class="list-blogs blog-main {{-- margin-top-30 --}}">
                    <div class="row">
                        @foreach ($servis as $servi)
                            <div class="col-lg-6">
                                <article class="blog-item">
                                    <div class="blog-item-thumbnail">
                                        <a href="{{ route('frontend.home.index') }}/dich-vu/{{ $servi->slug . '.html' }}">
                                            @php
                                                $img = $servi->img;
                                            @endphp
                                            <img src="{{ imageUrl('/storage/uploads/' . $img, '240', '160', '100', '1') }}"
                                                data-lazyload="{{ imageUrl('/storage/uploads/' . $img, '240', '160', '100', '1') }}"
                                                alt="{{ $servi->name }}" class="img-responsive center-block" />
                                        </a>
                                    </div>
                                    <div class="blog-item-mains">
                                        <h3 class="blog-item-name"><a
                                                href="{{ route('frontend.home.index') }}/dich-vu/{{ $servi->slug . '.html' }}"
                                                title="{{ $servi->title }}">{{ $servi->name }}</a></h3>
                                        {{-- <div class="post-time">
                                        <i class="ion ion-ios-calendar"></i> {{ date("d/m/Y", strtotime($servi->updated_at)) }} - Admin
                                    </div> --}}
                                        <p class="blog-item-summary margin-bottom-5"> {!! $servi->descriptions !!}</p>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <nav class="text-center" style="margin: 0 auto;">
                        <ul class="pagination justify-content-center">
                            {{ $servis->links('vendor.pagination.bootstrap-4') }}
                        </ul>
                    </nav>
                </section>
            </section>
        </div>
    </div>
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
    </script>
    {{-- <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":["CollectionPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $newcategory->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"description":"{{ $newcategory->descriptions }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $newcategory->name }}"}}]}]}</script> --}}
@endpush
