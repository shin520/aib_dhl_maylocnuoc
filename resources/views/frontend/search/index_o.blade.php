@extends("frontend.layout.master-layout")
@section("content")
<div class="container" style="margin-top: 10px">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $settings->nameindex }}">Trang chủ</a></li>
        <li class="breadcrumb-item" active>Kết quả tìm kiếm</li>
    </ol>
    </nav>
<form action="{{ route('search.index') }}" method="get" class="needs-validation" novalidate>
    <!-- Another variation with a button -->
    <div class="input-group mt-4 mb-4">
        <input type="search" class="form-control" placeholder="Tìm kiếm bài viết" name="search" id="validationCustom01" value="" required>
        <div class="input-group-append">
            <button class="btn btn-danger" type="submit" id="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="alert alert-success alert-search" role="alert">
@if(count($articles) > 0)
<h3 class="text-center">Kết quả tìm kiếm cho từ khoá <b> {{ $search }} </b> là <b>{{ $articles->count() }} </b> kết quả</h3>
@endif
</div>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mb-4">
    @foreach ($articles as $k => $article)
    <div class="card shadow mb-4 card-custom">
        <div class="content">
            <div class="row">
                <div class="col-sm-5">
                    <a href="{{ $article->slug.'.html'}}" title="{{ $article->name }}"><img class="card-img-top img-fluid" src="/storage/uploads/{{ $article->img }}" alt="{{ $article->name }}" title="{{ $article->title }}"></a>
                </div>
                <div class="col-sm-7">
                    <div class="card-body card-body-custom">
                    {{-- @foreach ($article->categories()->get() as $category)
                    <h6 class="category"><a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}"><i class="ti-folder"></i>&nbsp;
                        {{ $category->name }}
                        @endforeach
                    </a>
                    &nbsp;&nbsp;<i class="ti-time"></i>&nbsp;<time class="updated-at" datetime="{{ date("d/m/Y", strtotime($article->updated_at)) }}" itemprop="datePublished">{{ date("d/m/Y", strtotime($article->updated_at)) }}</time>&nbsp;&nbsp;<i class="ti-eye"></i>&nbsp;<span>{{ $article->view_count }}</span>
                </h6> --}}
                <div class="info">
                @foreach ($article->categories()->get() as $category)
                <i class="ti-folder"></i><a href="/bang-gia/{{ $category->slug.'.html' }}" title="{{ $category->title }}"> {{ $category->name }}</a> <i class="ti-reload"></i> <span datetime="{{ date("d/m/Y", strtotime($article->updated_at)) }}" itemprop="dateModified">{{ date("d/m/Y", strtotime($article->updated_at)) }}</span> <i class="ti-eye"></i> <span>{{ $article->view_count }}</span>
                @endforeach
                </div>
                <h3 class="card-title"><a href="{{ $article->slug.'.html'}}" title="{{ $article->title }}">{{ $article->name }}</a></h3>
                <p class="card-description">{{ $article->description }}</p>
                <a href="{{ $article->slug.'.html'}}" title="{{ $article->title }}" class="btn btn-primary btn-custom">&rarr; Chi tiết</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endforeach
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
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});
}, false);
})();
</script>
<script>
    var input = document.getElementById("q");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("submit").click();
        }
    });
@endpush