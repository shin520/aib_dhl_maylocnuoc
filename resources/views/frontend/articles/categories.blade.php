@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <h1 style="position:absolute; top:-1000px;">Tất cả Bảng giá</h1>
  <h2 style="position:absolute; top:-1000px;">Tất cả Bảng giá</h2>
  <h3 style="position:absolute; top:-1000px;">Tất cả Bảng giá</h3>
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $settings->title }}"><i class="ti-home"></i></a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="/categories/tat-ca-danh-muc.html" title="categories">Tất cả Bảng giá</a></li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-4">
      <article class="card shadow post">
        <div class="post-content" id="post_content">
          @foreach($categorydm as $category)
          <h3 class="title-categories" >
          <a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}"><i class="fa fa-folder-open" style="color: #00a781;"></i> {{ $category->name }}</a> <span style="color:#e91e63">({{ $category->articles->where('status','Published')->count() }})</span>
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