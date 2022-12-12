@extends("frontend.layout.master-layout")
@section("content")
<div class="container" >
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $settings->title }}"><i class="ti-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('frontend.new.index') }}" title="Tin tức">Tin tức</a></li>
      <li class="breadcrumb-item active" aria-current="page" title="{{ $blog->title }}">{{ $blog->name }}</li>
    </ol>
  </nav>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-4">
  <blog class="card shadow post">
    <div class="post-content" id="post_content">
      {{-- <h6 class="category"><a href="{{ route('frontend.new.index') }}" title="Tin tức"><i class="ti-folder"></i>&nbsp;
        Tin tức
      </a><i class="ti-reload"></i>&nbsp;<time class="updated-at" datetime="{{ date("d/m/Y", strtotime($blog->updated_at)) }}" itemprop="dateModified">{{ date("d/m/Y", strtotime($blog->updated_at)) }}</time>&nbsp;&nbsp;<i class="ti-eye"></i>&nbsp;<span>{{ $blog->view_count }}</span>
    </h6> --}}
    <div class="info">
    <i class="ti-folder"></i><a href="{{ route('frontend.new.index') }}" title="{{ $blog->title }}"> Tin tức</a> <i class="ti-reload"></i> <span datetime="{{ date("d/m/Y", strtotime($blog->updated_at)) }}" itemprop="dateModified">{{ date("d/m/Y", strtotime($blog->updated_at)) }}</span> <i class="ti-eye"></i> <span>{{ $blog->view_count }}</span>
    </div>
    <h1 class="title" >
      <a href="{{ $blog->slug.'.html' }}" title="{{ $blog->name }}" style="font-weight: bold;">{{ $blog->name }}
      </a>
    </h1>
    <h2 style="position:absolute; top:-1000px;">{{ $blog->name }}</h2>
    <h3 style="position:absolute; top:-1000px;">{{ $blog->name }}</h3>
    <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $blog->slug }}.html" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    <hr>
    <p>{!! $blog->content !!}</p>
    <hr>
    <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $blog->slug.'.html' }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    <hr>
    <div class="row">
      <div class="col-sm-6">
        @if (isset($previous))
        <a class="btn btn-danger btn-fill btn-tooltip btn-custom" data-toggle="tooltip" data-placement="top" href="{{ url('tin-tuc/'.$previous->slug.'.html') }}" title="{{ $previous->title }}" data-original-title="{{ $previous->title }}"><i class="ti-arrow-left"></i> Đọc bài trước</a>
        @endif
      </div>
      <div class="col-sm-6 text-right">
        @if (isset($next))
        <a class="btn btn-success btn-fill btn-tooltip btn-custom" data-toggle="tooltip" data-placement="top" href="{{ url('tin-tuc/'.$next->slug.'.html') }}" data-original-title="{{ $next->title }}">Đọc bài tiếp theo <i class="ti-arrow-right"></i></a>
        @endif
      </div>
    </div>
    <hr>
    @if($authors->hide_show == 1)
    <div class="row">
      <div class="col-3">
        <img class="img-fluid" src="/storage/uploads/{{ $authors->img }}" alt="{{ $authors->name }}" title="{{ $authors->name }}">
      </div>
      <div class="col-9">
        <h3 class="text-primary text-bold" style="margin: 0;font-weight: bold;">{{ $authors->name }}</h3>
        <p>{!! $authors->content !!}</p>
        <a href="{{ $authors->link_group }}" class="btn btn-success btn-fill btn-custom" target="_blank" title="{{ $authors->name }}">{{ $authors->namebuttonone }}</a> <a href="{{ $authors->link_group }}" class="btn btn-info btn-fill btn-custom" target="_blank" title="{{ $authors->name }}">{{ $authors->namebuttontwo }}</a>
      </div>
    </div>
    @endif
    <hr>
    <div class="fb-comments" data-href="{{ route('frontend.home.index') }}/{{ $blog->slug.'.html
    '}}" data-width="100%" data-numposts="5"></div>
  </div>
</div>
</blog>
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
  $('#post_content figure a').attr('title', '{{ $blog->title }}');
  $('#post_content figure a img').attr('title', '{{ $blog->title }}');
  $('#post_content figure a img').attr('alt', '{{ $blog->name }}');
  $('#post_content p a').attr('data-lightbox', 'photos');
  $('#post_content p a').attr('title', '{{ $blog->title }}');
  $('#post_content p a img').attr('title', '{{ $blog->title }}');
  $('#post_content p a img').attr('alt', '{{ $blog->name }}');
      </script>
@endpush