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
          <li>
            <a itemprop="url" href="/tin-tuc.html" title="Dịch vụ"><span itemprop="title">Dịch vụ</span></a>
            <span><i class="fa fa-angle-right"></i></span>
          </li>
          <li><strong itemprop="title">{{ $servi->name }}</strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="container article-wraper">
  <div class="row justify-content-center">
    <section class="right-content col-md-9 col-md-push-3">
      <article class="article-main" itemscope itemtype="http://schema.org/Article">
        <meta itemprop="mainEntityOfPage" content="/{{ $servi->slug.'.htmI' }}">
        <meta itemprop="description" content="{{ $servi->descriptions }}">
        <meta itemprop="author" content="{{ $setting->nameindex }}">
        <meta itemprop="headline" content="{{ $servi->name }}">
        <meta itemprop="image" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $servi->img }}">
        <meta itemprop="datePublished" content="{{ date("d/m/Y", strtotime($servi->created_at)) }}">
        <meta itemprop="dateModified" content="{{ date("d/m/Y", strtotime($servi->updated_at)) }}">
        <div class="hidden" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
          {{-- <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <img src="{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}" alt="{{ $setting->nameindex }}"/>
            <meta itemprop="url" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}">
            <meta itemprop="width" content="277">
            <meta itemprop="height" content="206">
          </div> --}}
          <meta itemprop="name" content="{{ $servi->name }}">
        </div>
        <div class="row">
          <div class="col-md-12">
            <h1 class="title-head">{{ $servi->name }}</h1>
            {{-- <div class="postby">
              <span>Đăng bởi <b>Admin</b> vào lúc {{ date("d/m/Y", strtotime($servi->updated_at)) }}</span>
            </div> --}}
            <div class="article-details" id="post_content">
              <div class="article-content">
                <div class="rte">
                  <div class="caption" id="fancy-image-view">
                    {!! $servi->content !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="col-md-12">
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a099baca270babc"></script>
            <div class="addthis_inline_share_toolbox_uu9r"></div>
          </div> --}}
          <div class="col-md-12">
            <div class="blog_related">
              <h2>Dịch vụ liên quan</h2>
              <div class="row">
                @foreach($servi_relationship as $related)
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <article class="blog_entry clearfix">
                    <div class="tempvideo">
                      {{-- <a href="{{ route('frontend.home.index') }}/{{ $related->slug.'.htmI' }}"> --}}
                        <a href="{{ route('frontend.home.index') }}/dich-vu/{{ $related->slug.'.html' }}">
                        @php
                        $img = $related->img;
                        @endphp
                        <img data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'192','128','100','1') }}" src="{{ imageUrl('/storage/uploads/'.$img,'192','128','100','1') }}" alt="{{ $related->name }}" class="img-responsive center-block" />
                      </a>
                    </div>
                    <h3 class="blog_entry-title">
                    <a class="line-clampss" rel="bookmark" href="{{ route('frontend.home.index') }}/dich-vu/{{ $related->slug.'.html' }}" title="{{ $related->title }}">{{ $related->name }}</a>
                    </h3>
                  </article>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </article>
    </section>
    <aside class="left left-content col-md-3 col-md-pull-9 d-none">
      {{-- <aside class="aside-item collection-category blog-category">
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
      </aside> --}}
      {{-- <div class="aside-item">
        <div class="heading">
          <h2 class="title-head">Dịch vụ khác</h2>
        </div>
        <div class="list-blogs">
          @foreach ($servi_relationship as $servi)
          @if($servi->hide_show == 1)
          <article class="blog-item blog-item-list clearfix">
            <a href="{{ route('frontend.home.index') }}/{{ $servi->slug.'.htmI' }}" class="panel-box-media">
              @php
              $img = $servi->img;
              @endphp
              <img src="{{ imageUrl('/storage/uploads/'.$img,'70','47','100','1') }}" data-lazyload="{{ imageUrl('/storage/uploads/'.$img,'70','47','100','1') }}" width="70" height="70" alt="{{ $servi->name }}" />
            </a>
            <div class="blogs-rights">
              <h3 class="blog-item-name"><a href="{{ route('frontend.home.index') }}/{{ $servi->slug.'.htm' }}" title="{{ $servi->name }}">{{ $servi->name }}</a></h3>
              <div class="post-time">{{ date("d/m/Y", strtotime($servi->updated_at)) }}</div>
            </div>
          </article>
          @endif
          @endforeach
        </div>
      </div> --}}
    </aside>
  </div>
</div>
@endsection

@push("style")
@endpush

@push("script")
{{-- <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}/#organization"}},{"@type":"ImageObject","@id":"{{ URL::current() }}#primaryimage","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $servi->img }}","width":1200,"height":675},{"@type":["WebPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $servi->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"primaryImageOfPage":{"@id":"{{ URL::current() }}#primaryimage"},"datePublished":"{{ $servi->created_at }}","dateModified":"{{ $servi->updated_at }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}/tin-tuc/@foreach ($servi->newcategories()->get() as $newcategory){{ $newcategory->slug.'.html' }}@endforeach","url":"{{ route('frontend.home.index') }}/tin-tuc/@foreach ($servi->newcategories()->get() as $newcategory){{ $newcategory->slug.'.html' }}@endforeach","name":"{{ $servi->name }}"}},{"@type":"ListItem","position":3,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $servi->name }}"}}]},{"@type":"Article","@id":"{{ URL::current() }}#article","isPartOf":{"@id":"{{ URL::current() }}#webpage"},"author":{"@id":"{{ route('frontend.author.index') }}","name":"{{ $author->name }}"},"headline":"{{ $servi->name }}","datePublished":"{{ $servi->created_at }}","dateModified":"{{ $servi->updated_at }}","mainEntityOfPage":{"@id":"{{ URL::current() }}#webpage"},"publisher":{"@id":"{{ route('frontend.home.index') }}#organization"},"image":{"@id":"{{ URL::current() }}#primaryimage"},"keywords":"{{ $servi->keywords }}"},{"@type":["Person"],"@id":"{{ route('frontend.author.index') }}","name":"{{ $author->name }}","image":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#authorlogo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $author->img }}","caption":"{{ $author->name }}"},"description":"{!! $author->content !!}","sameAs":["{{ $author->link_author }}"]}]}</script> --}}
@endpush