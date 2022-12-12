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
                    <li><strong itemprop="title"><a href="/tin-tuc.html">Tin tức</a></strong>
                    <span><i class="fa fa-angle-right"></i></span></li>
                    <li><strong itemprop="title">{{ $newcategory->name }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container" itemscope itemtype="http://schema.org/Blog">
    <meta itemprop="name" content="Tin tức">
    <meta itemprop="description" content="{{ $newcategory->descriptions }}">
    <div class="row">
        <section class="right-content col-md-9 col-md-push-3 list-blog-page">
            <div class="box-heading hidden">
                <h1 class="title-head">Tin tức</h1>
            </div>
            <div class="news-list-main aside-item collection-category blog-category">
                <div class="heading">
                    <h2 class="title-head"><span>{{ $newcategory->name }}</span></h2>
                </div>
                {{-- <div class="newslist latest">
                    <div class="row">
                        @foreach ($posts as $post)
                        @if($post->hide_show == 1 and $post->status == 'Published')
                        <div class="col-md-6 col-sm-6 margin-top-10">
                            <div class="later_news_big">
                                <div class="tempvideo">
                                    <a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}">
                                        @php
                                        $img = $post->img;
                                        @endphp
                                        <img data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'399','266','100','1') }}" src="{{ imageUrl('/storage/uploads/'.$img,'399','266','100','1') }}" alt="{{ $post->name }}" class="img-responsive center-block" />
                                    </a>
                                </div>
                                <h3>
                                <a class="line-clamps" href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}" title="{{ $post->name }}">{{ $post->name }}</a>
                                </h3>
                                <div class="post-time">
                                    <i class="ion ion-ios-calendar"></i> {{ date("d/m/Y", strtotime($post->updated_at)) }}
                                </div>
                                <figure>
                                    {!! $post->descriptions !!}
                                </figure>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div> --}}
            </div>
            <section class="list-blogs blog-main margin-top-30">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
                        <article class="blog-item">
                            <div class="blog-item-thumbnail">
                                <a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}">
                                    @php
                                    $img = $post->img;
                                    @endphp
                                    <img src="{{ imageUrl('/storage/uploads/'.$img,'240','160','100','1') }}" data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'240','160','100','1') }}" alt="{{ $post->name }}" class="img-responsive center-block" />
                                </a>
                            </div>
                            <div class="blog-item-mains">
                                <h3 class="blog-item-name"><a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}" title="{{ $post->title }}">{{ $post->name }}</a></h3>
                                <div class="post-time">
                                    <i class="ion ion-ios-calendar"></i> {{ date("d/m/Y", strtotime($post->updated_at)) }}
                                </div>
                                <p class="blog-item-summary margin-bottom-5">  {!! $post->descriptions !!}</p>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </section>
        </section>
        <aside class="left left-content col-md-3 col-md-pull-9">
            <aside class="aside-item collection-category blog-category">
                <div class="heading">
                    <h2 class="title-head"><span>Danh mục bài viết</span></h2>
                </div>
                <div class="aside-content">
                    <nav class="nav-category  navbar-toggleable-md" >
                        <ul class="nav navbar-pills">
                            @foreach ($newcategories as $k => $newcategory)
                            <li class="nav-item active"><a class="nav-link" href="{{ route('frontend.home.index') }}/tin-tuc/{{ $newcategory->slug.'.html' }}" title="{{ $newcategory->title }}">{{ $newcategory->name }}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="aside-item">
                <div class="heading">
                    <h2 class="title-head">Tin tức nổi bật</h2>
                </div>
                <div class="list-blogs">
                    @foreach ($posts_is_featureds as $post)
                    <article class="blog-item blog-item-list clearfix">
                        <a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}" class="panel-box-media">
                            @php
                            $img = $post->img;
                            @endphp
                            <img src="{{ imageUrl('/storage/uploads/'.$img,'70','47','100','1') }}" data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'70','47','100','1') }}" width="70" height="70" alt="{{ $post->name }}" />
                        </a>
                        <div class="blogs-rights">
                            <h3 class="blog-item-name"><a href="{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}" title="{{ $post->name }}">{{ $post->name }}</a></h3>
                            <div class="post-time">{{ date("d/m/Y", strtotime($post->updated_at)) }}</div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </aside>
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
<script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":["CollectionPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $newcategory->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"description":"{{ $newcategory->descriptions }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $newcategory->name }}"}}]}]}</script>
@endpush