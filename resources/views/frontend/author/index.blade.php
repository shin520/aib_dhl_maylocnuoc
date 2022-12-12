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
          <li><strong itemprop="title">Tác giả</strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="container contact">
  <div class="row">
    <div class="col-md-4">
      <div class="widget-item info-contact in-fo-page-content">
        <h1 class="title-head">Thông tin liên hệ</h1>
        <ul class="widget-menu contact-info-page">
          <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $setting->address }}</li>
          <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{ $setting->hotline_1 }}">{{ $setting->hotline_1 }}</a></li>
          <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
        </ul>
      </div>
      <div class="box-maps margin-top-10 margin-bottom-10">
        {!! $setting->maps !!}
      </div>
    </div>
    <div class="col-md-8">
      <div class="page-login">
        <h1 class="heading" style="position:absolute; top:-1000px;">Tác giả</h1>
        <h2 class="heading" style="position:absolute; top:-1000px;">Tác giả</h2>
        <h3 class="heading" style="position:absolute; top:-1000px;">Tác giả</h3>
        <div id="login">
          <h3 class="title-head text-center">Thông tin Tác giả</h3>
          <span class="text-center block"></span>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <h1 class="heading" style="position:absolute; top:-1000px;">Tác giả</h1>
              <h2 class="heading" style="position:absolute; top:-1000px;">Tác giả</h2>
              <h3 class="heading" style="position:absolute; top:-1000px;">Tác giả</h3>
              <div class="content-page rte" id="post_content">
                <div class="row text-center">
                  @if($authors->hide_show == 1)
                  <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <img class="img-fluid" src="/storage/uploads/{{ $authors->img }}" alt="{{ $authors->name }}" title="{{ $authors->name }}" style="margin-bottom: 40px">
                  </div>
                  <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <h3 class="text-danger text-bold" style="margin: 0;font-weight: bold;">{{ $authors->name }}</h3>
                    <p style="margin-top: 6px;">{{ $setting->website }}</p>
                    <p>{!! $authors->content !!}</p>
                    {{-- <a href="{{ $authors->link_group }}" class="btn btn-success btn-fill btn-custom" target="_blank" title="{{ $authors->name }}">{{ $authors->namebuttonone }}</a> <a href="{{ $authors->link_group }}" class="btn btn-info btn-fill btn-custom" target="_blank" title="{{ $authors->name }}">{{ $authors->namebuttontwo }}</a> --}}
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
.box-maps{height: 350px;overflow: hidden;}
footer.footer-other{margin-top:0;}
.search-more{margin-top:0;}
</style>
@endsection

@push("style")
@endpush

@push("script")
@endpush