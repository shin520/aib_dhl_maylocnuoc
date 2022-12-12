@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-4 main-content">
      <nav aria-label="breadcrumb" style="margin-top: 46px">
        <ol class="breadcrumb shadow-sm">
          <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title=""><i class="ti-home"></i> Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{ route('frontend.news') }}" title="Tin tức">Tin tức</a></li>
          <li class="breadcrumb-item" aria-current="page">
            @foreach ($post->newcategories()->get() as $newcategory)
            <a href="/tin-tuc/{{ $newcategory->slug.'.html' }}" title="{{ $newcategory->name }}">{{ $newcategory->name }}
              @endforeach
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="{{ $post->name }}">{{ $post->name }}</a></li>
        </ol>
      </nav>
      <article class="card shadow post">
        <div class="post-content" id="post_content">
          <div class="info">
          {{-- @foreach ($article->categories()->get() as $category)
          <i class="ti-folder"></i><a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}"> {{ $category->name }}</a> <i class="ti-reload"></i> <span datetime="{{ date("d/m/Y", strtotime($article->updated_at)) }}" itemprop="dateModified">{{ date("d/m/Y", strtotime($article->updated_at)) }}</span> <i class="ti-eye"></i> <span>{{ $article->view_count }}</span>
          @endforeach --}}
          </div>
          <div class="main-title">
            <h1 class="title" >
            <a href="{{ $post->slug.'.html' }}" title="{{ $post->name }}" style="font-weight: bold;">{{ $post->name }}</a>
            </h1>
          </div>
            <h2 style="position:absolute; top:-1000px;">{{ $post->name }}</h2>
            <h3 style="position:absolute; top:-1000px;">{{ $post->name }}</h3>
            {{-- <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $post->slug }}.html" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
            <hr>
            <div class="mb-4">
            {!! $post->content !!}
            </div>
            {{-- @foreach ($post->tags()->get() as $tag)
            @if($tag->hide_show == 1 && $tag->status == "Published")
            <div class="post-tag">
              <li>
                <span><h3 class="tag-custom" style="text-transform: none; font-size: 15px !important;"><a href="/tag/{{ $tag->slug.'.html' }}" title="{{ $tag->title }}"><i class="fa fa-tag"></i> {{ $tag->name }}</a></h3></span>
              </li>
            </div>
            @endif
            @endforeach --}}
            {{-- <div class="fb-like" data-href="{{ route('frontend.home.index') }}/{{ $post->slug.'.html' }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
            <div class="row mb-5">
              <div class="col-sm-6">
                @if (isset($previous))
                <a class="btn btn-danger btn-fill btn-tooltip btn-custom mb-3" data-toggle="tooltip" data-placement="top" href="{{ url($previous->slug.'.htmI') }}" title="Xem chi tiết" data-original-title="Đọc bài trước"><i class="ti-arrow-left"></i> Đọc bài trước</a>
                  <div class="thumbnail-news mb-2">
                    @php
                     $img = $previous->img;
                    @endphp
                    <a href="{{ route('frontend.home.index') }}/{{ $previous->slug.'.htmI' }}">
                      <img src="{{ imageUrl('/storage/uploads/'.$img,'400','200','100','1') }}" class="img-fluid" alt="{{ $previous->name }}" title="{{ $previous->name }}" style="border: none;padding: 0;border-radius: 0;">
                    </a>
                  </div>
                  <figcaption class="text-center">
                  <div class="time-author">
                    <span><i class="ti ti-time"></i> {{ date("d/m/Y", strtotime($previous->updated_at)) }}</span><span><i class="ti ti-pencil ml-3"></i> Madam Saigon</span><span><i class="ti ti-eye ml-3"></i> {{ $post->view_count }}</span>
                  </div>
                  <div class="title-madamsaigon">
                    <h3><a href="{{ route('frontend.home.index') }}/{{ $previous->slug.'.htmI' }}">{{ $previous->name }}</a></h3>
                  </div>
                  <div class="descriptions-news">
                    {!! $previous->descriptions !!}
                  </div>
                  </figcaption>

                @endif
              </div>
              <div class="col-sm-6 text-right">
                @if (isset($next))
                <a class="btn btn-success btn-fill btn-tooltip btn-custom mb-3" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="{{ url($next->slug.'.htmI') }}" data-original-title="Đọc bài tiếp theo">Đọc bài tiếp theo <i class="ti-arrow-right"></i></a>
                  <div class="thumbnail-news mb-2">
                    @php
                     $img = $next->img;
                    @endphp
                    <a href="{{ route('frontend.home.index') }}/{{ $next->slug.'.htmI' }}">
                      <img src="{{ imageUrl('/storage/uploads/'.$img,'400','200','100','1') }}" class="img-fluid" alt="{{ $next->name }}" title="{{ $next->name }}" style="border: none;padding: 0;border-radius: 0;">
                    </a>
                  </div>
                  <figcaption class="text-center">
                  <div class="time-author">
                    <span><i class="ti ti-time"></i> {{ date("d/m/Y", strtotime($next->updated_at)) }}</span><span><i class="ti ti-pencil ml-3"></i> Madam Saigon</span><span><i class="ti ti-eye ml-3"></i> {{ $post->view_count }}</span>
                  </div>
                  <div class="title-madamsaigon">
                    <h3><a href="{{ route('frontend.home.index') }}/{{ $next->slug.'.htmI' }}">{{ $next->name }}</a></h3>
                  </div>
                  <div class="descriptions-news">
                    {!! $next->descriptions !!}
                  </div>
                  </figcaption>
                @endif
              </div>
            </div>
            @if($author->hide_show == 1)
            <hr>
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
            <div class="fb-comments" data-href="{{ route('frontend.home.index') }}/{{ $post->slug.'.html
            '}}" data-width="100%" data-numposts="5"></div> --}}
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
      // $('#post_content figure a img').attr('alt', '{{ $post->name }}');
      $('#post_content p a').attr('data-lightbox', 'photos');
      // $('#post_content p a').attr('title', '');
      // $('#post_content p a img').attr('title', '');
      // $('#post_content p a img').attr('alt', '{{ $post->name }}');
      </script>
      <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $setting->nameindex }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}/#organization"}},{"@type":"ImageObject","@id":"{{ URL::current() }}#primaryimage","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $post->img }}","width":1200,"height":675},{"@type":["WebPage"],"@id":"{{ URL::current() }}#webpage","url":"{{ URL::current() }}","inLanguage":"{{ $setting->lang }}","name":"{{ $post->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"primaryImageOfPage":{"@id":"{{ URL::current() }}#primaryimage"},"datePublished":"{{ $post->created_at }}","dateModified":"{{ $post->updated_at }}","breadcrumb":{"@id":"{{ URL::current() }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ URL::current() }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}/tin-tuc/@foreach ($post->newcategories()->get() as $newcategory){{ $newcategory->slug.'.html' }}@endforeach","url":"{{ route('frontend.home.index') }}/tin-tuc/@foreach ($post->newcategories()->get() as $newcategory){{ $newcategory->slug.'.html' }}@endforeach","name":"{{ $post->name }}"}},{"@type":"ListItem","position":3,"item":{"@type":"WebPage","@id":"{{ URL::current() }}","url":"{{ URL::current() }}","name":"{{ $post->name }}"}}]},{"@type":"Article","@id":"{{ URL::current() }}#article","isPartOf":{"@id":"{{ URL::current() }}#webpage"},"author":{"@id":"{{ route('frontend.author.index') }}","name":"{{ $author->name }}"},"headline":"{{ $post->name }}","datePublished":"{{ $post->created_at }}","dateModified":"{{ $post->updated_at }}","mainEntityOfPage":{"@id":"{{ URL::current() }}#webpage"},"publisher":{"@id":"{{ route('frontend.home.index') }}#organization"},"image":{"@id":"{{ URL::current() }}#primaryimage"},"keywords":"{{ $post->keywords }}"},{"@type":["Person"],"@id":"{{ route('frontend.author.index') }}","name":"{{ $author->name }}","image":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#authorlogo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $author->img }}","caption":"{{ $author->name }}"},"description":"{!! $author->content !!}","sameAs":["{{ $author->link_author }}"]}]}</script>
      @endpush