@extends("frontend.layout.master-layout")
@section("content")
<div class="container" >
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title=""><i class="ti-home"></i></a></li>
      <li class="breadcrumb-item"><a href="/categories/tat-ca-danh-muc.html" title="categories">Bảng giá</a></li>
      <li class="breadcrumb-item" aria-current="page">
        @foreach ($article->categories()->get() as $category)
        <a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->name }}">{{ $category->name }}
          @endforeach
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $article->name }}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-4">
      <article class="card shadow post">
        <div class="post-content" id="post_content">
          <div class="info">
          @foreach ($article->categories()->get() as $category)
          <i class="ti-folder"></i><a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}"> {{ $category->name }}</a> <i class="ti-reload"></i> <span datetime="{{ date("d/m/Y", strtotime($article->updated_at)) }}" itemprop="dateModified">{{ date("d/m/Y", strtotime($article->updated_at)) }}</span> <i class="ti-eye"></i> <span>{{ $article->view_count }}</span>
          @endforeach
          </div>
            <h1 style="position:absolute; top:-1000px;">{{ $article->name }}</h1>
            <h2 class="title" >
            <a href="{{ $article->slug.'.html' }}" title="{{ $article->name }}" style="font-weight: bold;">{{ $article->name }}</a>
            </h2>
            <h3 style="position:absolute; top:-1000px;">{{ $article->name }}</h3>
            <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $article->slug }}.html" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            <hr>
            <p>{!! $article->content !!}</p>
            @foreach ($article->tags()->get() as $tag)
            @if($tag->hide_show == 1 && $tag->status == "Published")
            <div class="article-tag">
              <li>
                <span><h3 class="tag-custom" style="text-transform: none; font-size: 15px !important;"><a href="/tag/{{ $tag->slug.'.html' }}" title="{{ $tag->title }}"><i class="fa fa-tag"></i> {{ $tag->name }}</a></h3></span>
              </li>
            </div>
            @endif
            @endforeach
            <hr>
            <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html' }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            <hr>
            <div class="row">
              <div class="col-sm-6">
                @if (isset($previous))
                <a class="btn btn-danger btn-fill btn-tooltip btn-custom" data-toggle="tooltip" data-placement="top" href="{{ url($previous->slug.'.html') }}" title="{{ $previous->title }}" data-original-title="{{ $previous->title }}"><i class="ti-arrow-left"></i> Đọc bài trước</a>
                @endif
              </div>
              <div class="col-sm-6 text-right">
                @if (isset($next))
                <a class="btn btn-success btn-fill btn-tooltip btn-custom" data-toggle="tooltip" data-placement="top" title="{{ $next->title }}" href="{{ url($next->slug.'.html') }}" data-original-title="{{ $next->title }}">Tiếp theo <i class="ti-arrow-right"></i></a>
                @endif
              </div>
            </div>
            @if($author->hide_show == 1)
            <hr>
            <div class="row">
              <div class="col-3">
                <img class="img-fluid" src="/storage/uploads/{{ $author->img }}" alt="{{ $author->name }}" title="{{ $author->name }}">
              </div>
              <div class="col-9">
                <h3 class="text-primary text-bold" style="margin: 0;font-weight: bold;">{{ $author->name }}</h3>
                <p>{!! $author->content !!}</p>
                <a href="{{ $author->link_group }}" class="btn btn-success btn-fill btn-custom" target="_blank" title="{{ $author->name }}">{{ $author->namebuttonone }}</a> <a href="{{ $author->link_group }}" class="btn btn-info btn-fill btn-custom" target="_blank" title="{{ $author->name }}">{{ $author->namebuttontwo }}</a>
              </div>
            </div>
            @endif
            <hr>
            <div class="fb-comments" data-href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html
            '}}" data-width="100%" data-numposts="5"></div>
          </div>
        </div>
      </article>
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
        // $('img').click(function () {
        //     var alt = $(this).attr("alt")
        //     // alert(alt);
        // });
      $(function(){
         $("a img").each(function(){
              $(this).attr("title", $(this).find("img").attr("alt"));
         });
      });
      $('#post_content img').addClass('img-fluid');
      $('#post_content').addClass('photos');
      $('#post_content figure a').attr('data-lightbox', 'photos');
      // $('#post_content figure a').attr('title', '');
      // $('#post_content figure a img').attr('title', '');
      // $('#post_content figure a img').attr('alt', '{{ $article->name }}');
      $('#post_content p a').attr('data-lightbox', 'photos');
      // $('#post_content p a').attr('title', '');
      // $('#post_content p a img').attr('title', '');
      // $('#post_content p a img').attr('alt', '{{ $article->name }}');

      </script>
      @endpush