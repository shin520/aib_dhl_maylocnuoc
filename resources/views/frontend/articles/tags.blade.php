@extends("frontend.layout.master-layout")
@section("content")
<div class="container" >
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $settings->nameindex }}">Trang chủ</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="/tags/all-tags.html" title="Tất cả Tags">Tất cả Tags</a></li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-9 col-xl-9 mb-4">
      <article class="card shadow post">
        <div class="post-content" id="post_content">
          @foreach($tags as $tag)
          <h1 class="title-categories" >
          <a href="/tag/{{ $tag->slug.'.html' }}" title="{{ $tag->title }}"><i class="ti-tag" style="color: #00a781;"></i> {{ $tag->name }}<h6 style="display: inline;">&nbsp;<span style="color: #c11f1f;">({{ $tag->articles->count() }})</span></h6>
        </a>
        </h1>
        @endforeach
      </div>
    </div>
  </article>
  @endsection
  @push("style")
  @endpush
  @push("script")
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
  $('#post_content p a').attr('data-lightbox', 'photos');
  </script>
  @endpush