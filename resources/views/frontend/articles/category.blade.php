@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
      <li class="breadcrumb-item">Hosting</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
    </ol>
  </nav>
  <div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
  <article class="card shadow post">
    <div class="post-content">
    <div class="hosting-price" id="post_content">
      <div class="main-title text-center">
        <h1 class="title" >
        <a href="{{ URL::current() }}" title="{{ $category->name }}" style="font-weight: bold;">{{ $category->name }}</a>
        </h1>
      </div>
      <h2 style="position:absolute; top:-1000px;">{{ $category->name }}</h2>
      <h3 style="position:absolute; top:-1000px;">{{ $category->name }}</h3>
      {{-- <div class="fb-like" data-href="{{ route('frontend.about.index') }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
      <hr>
      <div class="container">
          <div class="row">
            @foreach ($articles as $article)
            @if($article->hide_show == 1 and $article->status == 'Published' and $articles = Article::orderBy('stt', 'asc'))
              <div class="col-6 col-xs-6 col-sm-4 col-md-4 col-lg-3 col-xl-2 box-hosting">
                  <div class="panel panel-primary" style="border-top: 3px solid {{ $article->color }};
    border-bottom: 3px solid {{ $article->color }};" {{-- style="border: 1px solid #0fa54a;border-radius: 15px;" --}}>
                      <div class="panel-heading">
                          <h3 class="panel-title mt-3">
                              {{ $article->name }}</h3>
                      </div>
                      <div class="panel-body">
                        <div class="the-price" style="background-color:{{ $article->color }};">
                            {{-- <h3><span class="price-m">{{ $article->price }} ₫</span><span class="p-month"> /tháng</span></h3> --}}
                            <h3><span class="memory">{{ $article->memory }}GB</span><div class="memory-cus">Dung lượng <strong>SSD</strong></div></h3>
                        </div>
                          
                          {!! $article->content !!}
                          <div class="the-price" {{-- style="background-color:pink;" --}}>
                              {{-- <h3><span class="price-m">{{ $article->price }} ₫</span><span class="p-month"> /tháng</span></h3> --}}
                              <h3><span class="price-m">{{ $article->price }}</span><div class="p-month"> ₫/tháng</div></h3>
                          </div>
                          <div class="the-price" {{-- style="background-color:pink;" --}}>
                              {{-- <h3><span class="price-m">{{ $article->price }} ₫</span><span class="p-month"> /tháng</span></h3> --}}
                              <h3><span class="price-m">{{ $article->prices }}</span><div class="p-month"> ₫/năm</div></h3>
                          </div>
                      </div>
                      {{-- <div class="panel-footer mb-3 mt-3">
                          <a href="#" class="btn btn-success" role="button">Đăng ký</a>
                      </div> --}}
                  </div>
              </div>
              @endif
              @endforeach
              {{-- <div class="col-xs-12 col-md-4">
                  <div class="panel panel-success" style="border: 1px solid #0fa54a;border-radius: 15px;">
                      <div class="cnrflash">
                          <div class="cnrflash-inner">
                              <span class="cnrflash-label">MOST
                                  <br>
                                  POPULR</span>
                          </div>
                      </div>
                      <div class="panel-heading">
                          <h3 class="panel-title">
                              Silver</h3>
                      </div>
                      <div class="panel-body">
                          <div class="the-price">
                              <h1>
                                  $20<span class="subscript">/mo</span></h1>
                              <small</small>
                          </div>
                          <table class="table">
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      2 Account
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      5 Project
                                  </td>
                              </tr>
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      100K API Access
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      200MB Storage
                                  </td>
                              </tr>
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      Custom Cloud Services
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      Weekly Reports
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="panel-footer mb-3">
                          <a href="#" class="btn btn-success" role="button">Đăng ký</a>
                         </div>
                  </div>
              </div> --}}
              {{-- <div class="col-xs-12 col-md-4">
                  <div class="panel panel-info" style="border: 1px solid #0fa54a;border-radius: 15px;">
                      <div class="panel-heading">
                          <h3 class="panel-title">
                              Gold</h3>
                      </div>
                      <div class="panel-body">
                          <div class="the-price">
                              <h1>
                                  $35<span class="subscript">/mo</span></h1>
                              <small</small>
                          </div>
                          <table class="table">
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      5 Account
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      20 Project
                                  </td>
                              </tr>
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      300K API Access
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      500MB Storage
                                  </td>
                              </tr>
                              <tr>
                                  <td style="border-left: none; border-right:none;">
                                      Custom Cloud Services
                                  </td>
                              </tr>
                              <tr class="active">
                                  <td style="border-left: none; border-right:none;">
                                      Weekly Reports
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="panel-footer mb-3">
                          <a href="#" class="btn btn-success" role="button">Đăng ký</a></div>
                  </div>
              </div> --}}
          </div>
      </div>
      </div>
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
$('#post_content figure a').attr('title', '{{ $abouts->title }}');
$('#post_content figure a img').attr('title', '{{ $abouts->title }}');
$('#post_content figure a img').attr('alt', '{{ $abouts->name }}');
$('#post_content p a').attr('data-lightbox', 'photos');
$('#post_content p a').attr('title', '{{ $abouts->title }}');
$('#post_content p a img').attr('title', '{{ $abouts->title }}');
$('#post_content p a img').attr('alt', '{{ $abouts->name }}');
</script>
@endpush