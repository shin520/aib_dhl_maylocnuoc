@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-4 main-content">
            <nav aria-label="breadcrumb" style="margin-top: 46px">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $abouts->name }}</li>
                </ol>
            </nav>
            <article class="card shadow post">
                <div class="post-content" id="post_content">
                    <div class="main-title">
                        <h1 class="title">
                            {{ $abouts->name }}
                        </h1>
                    </div>
                    <h2 style="position:absolute; top:-1000px;">{{ $abouts->name }}</h2>
                    <h3 style="position:absolute; top:-1000px;">{{ $abouts->name }}</h3>
                    {{-- <div class="fb-like" data-href="{{ route('frontend.about.index') }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
                    <hr>
                    <p>{!! $abouts->content !!}</p>
                    <hr>
                    {{-- <div class="fb-like" data-href="{{ route('frontend.about.index') }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
                    @if($author->hide_show == 1)
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('frontend.author.index') }}" title="{{ $author->name }}"><img class="img-fluid" src="/storage/uploads/{{ $author->img }}" alt="{{ $author->name }}" title="{{ $author->name }}"></a>
                        </div>
                        <div class="col-9">
                            <a href="{{ route('frontend.author.index') }}" title="{{ $author->name }}"><h3 class="text-danger text-bold" style="margin: 0;font-weight: bold;">{{ $author->name }}</h3></a>
                            <p>{!! $author->content !!}</p>
                            <a href="{{ $author->link_group }}" class="btn btn-success btn-fill btn-custom" target="_blank" title="{{ $author->name }}">{{ $author->namebuttonone }}</a> <a href="{{ $author->link_group }}" class="btn btn-info btn-fill btn-custom" target="_blank" title="{{ $author->name }}">{{ $author->namebuttontwo }}</a>
                        </div>
                    </div>
                    @endif
                    {{-- <hr>
                    <div class="fb-comments" data-href="{{ route('frontend.about.index') }}" data-width="100%" data-numposts="5"></div> --}}
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
        $('#post_content img').addClass('img-fluid');
        $('#post_content').addClass('photos');
        $('#post_content figure a').attr('data-lightbox', 'photos');
        $('#post_content figure a').attr('title', '{{ $master['title'] }}');
        $('#post_content figure a img').attr('title', '{{ $master['title'] }}');
        $('#post_content figure a img').attr('alt', '{{ $master['name'] }}');
        $('#post_content p a').attr('data-lightbox', 'photos');
        $('#post_content p a').attr('title', '{{ $master['title'] }}');
        $('#post_content p a img').attr('title', '{{ $master['title'] }}');
        $('#post_content p a img').attr('alt', '{{ $master['name'] }}');
        </script>
        <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $master['name'] }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":["WebPage"],"@id":"{{ route('frontend.about.index') }}#webpage","url":"{{ route('frontend.about.index') }}","inLanguage":"{{ $setting->lang }}","name":"{{ $master['name'] }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"datePublished":"{{ $abouts->created_at }}","dateModified":"{{ $abouts->updated_at }}","description":"{{ $master['descriptions'] }}","breadcrumb":{"@id":"{{ route('frontend.about.index') }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ route('frontend.about.index') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.about.index') }}","url":"{{ route('frontend.about.index') }}","name":"{{ $master['name'] }}"}}]}]}</script>
        @endpush