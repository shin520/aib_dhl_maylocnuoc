@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
    <nav aria-label="breadcrumb" style="margin-top: 10px">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="ti-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/tags/all-tags.html">Tags</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $tag->name }}
            </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-4">
            <h1 class="heading text-center" style="color:#222222">{{ $tag->name }}</h1>
            @php
            if (!$tag->articles->count()){
            echo "<p class='text-danger text-center'>Nội dung đang cập nhật...</p>";
            }
            @endphp
            @foreach ($articles as $article)
            <div class="card shadow mb-4 card-custom">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-5">
                            <a href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html'}}" title="{{ $article->title }}"><img class="card-img-top img-fluid" src="/storage/uploads/{{ $article->img }}" alt="{{ $article->name }}" title="{{ $article->title }}"></a>
                        </div>
                        <div class="col-sm-7">
                            @foreach ($article->categories()->get() as $category)
                            <h6 class="category"><a href="/category/{{ $category->slug.'.html' }}" title="{{ $category->title }}"><i class="ti-folder"></i>
                                {{ $category->name }}
                                @endforeach
                            </a>
                            &nbsp;&nbsp;<i class="ti-time"></i>&nbsp;<time class="updated-at" datetime="{{ date("d/m/Y", strtotime($article->updated_at)) }}" itemprop="datePublished">{{ date("d/m/Y", strtotime($article->updated_at)) }}</time>&nbsp;&nbsp;<i class="ti-eye"></i>&nbsp;<span>{{ $article->view_count }}</span>
                            </h6>
                            <h2 class="card-title"><a href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html'}}">{{ $article->name }}</a></h2>
                            <p class="card-">{{ $article->description }}</p>
                            <a href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html'}}" title="{{ $article->title }}" class="btn btn-primary btn-custom"><i class="ti-arrow-right"></i> Đọc tiếp bài viết</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <nav>
                <ul class="pagination justify-content-center mb-4">
                    {{$articles->links('vendor.pagination.bootstrap-4')}}
                </ul>
            </nav>
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
        @endpush