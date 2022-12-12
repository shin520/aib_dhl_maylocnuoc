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
            <strong itemprop="title">Hướng dẫn</strong><span> <i class="fa fa-angle-right"></i></span>
          </li>
          <li><strong itemprop="title">{{ $tutorial->name }}</strong></li>
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
          <h1 class="title-head"><a href="{{ URL::current() }}">{{ $tutorial->name }}</a></h1>
        </div>
        <div class="content-page rte" id="post_content">
          <p>{!! $tutorial->content !!}</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push("style")
@endpush

@push("script")
<script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}/#organization"}},{"@type":"ImageObject","@id":"{{ URL::current() }}#primaryimage","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $tutorial->img }}","width":1200,"height":675},{"@type":["WebPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $tutorial->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"primaryImageOfPage":{"@id":"{{ URL::current() }}#primaryimage"},"datePublished":"{{ $tutorial->created_at }}","dateModified":"{{ $tutorial->updated_at }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $tutorial->name }}"}}]},{"@type":"Article","@id":"{{ URL::current() }}#article","isPartOf":{"@id":"{{ URL::current() }}#webpage"},"author":{"@id":"{{ route('frontend.home.index') }}/#/schema/person/20f2f5b716256f77986451b4794a8f213fd","name":"{{ $author->name }}"},"headline":"{{ $tutorial->name }}","datePublished":"{{ $tutorial->created_at }}","dateModified":"{{ $tutorial->updated_at }}","mainEntityOfPage":{"@id":"{{ URL::current() }}#webpage"},"publisher":{"@id":"{{ route('frontend.home.index') }}#organization"},"image":{"@id":"{{ URL::current() }}#primaryimage"},"keywords":"{{ $tutorial->keywords }}"},{"@type":["Person"],"@id":"{{ route('frontend.author.index') }}","name":"{{ $author->name }}","image":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#authorlogo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $author->img }}","caption":"{{ $author->name }}"},"description":"{!! $author->content !!}","sameAs":["{{ $author->link_author }}"]}]}</script>
@endpush