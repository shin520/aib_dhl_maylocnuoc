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
                    <li><strong itemprop="title">Giới thiệu</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="page-title category-title">
                    <h1 class="title-head"><a href="{{ route('frontend.about.index') }}">Giới thiệu</a></h1>
                </div>
                <div class="content-page rte" id="post_content">
                    <p>{!! $abouts->content !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("style")
@endpush

@push("script")
<script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $master['name'] }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":["WebPage"],"@id":"{{ route('frontend.about.index') }}#webpage","url":"{{ route('frontend.about.index') }}","inLanguage":"{{ $setting->lang }}","name":"{{ $master['name'] }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"datePublished":"{{ $abouts->created_at }}","dateModified":"{{ $abouts->updated_at }}","description":"{{ $master['descriptions'] }}","breadcrumb":{"@id":"{{ route('frontend.about.index') }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ route('frontend.about.index') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.about.index') }}","url":"{{ route('frontend.about.index') }}","name":"{{ $master['name'] }}"}}]}]}</script>
@endpush