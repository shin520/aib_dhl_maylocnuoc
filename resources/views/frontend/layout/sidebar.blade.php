<!-- Sidebar Widgets Column -->
<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
    <aside class="sidebar">
        <div class="widget my-4">
            <div class="widget-heading text-center"><h3>Search Google</h3></div>
            <div class="card list-group-item">
                <div class="card-search">
                    <form role="search" onsubmit="return before_search();" action="https://google.com/search">
                        <div class="input-group">
                            <input type="hidden" id="search_q" name="q" value="">
                            <input type="search" id="search_input" class="form-control" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary btn-search-custom"><i class="ti-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Categories Widget -->
        <div class="widget my-4">
            <div class="widget-heading text-center"><h3>Bảng giá</h3></div>
            <ul class="card list-group widget-style">
                @foreach ($categories as $k => $category1)
                @if($category1->hide_show == 1 and $category1->status == 'Published')
                <li class="list-group-item">
                    <h3><a href="/bang-gia/{{ $category1->slug.'.html' }}" title="{{ $category1->title }}">{{ $category1->name }}</a></h3><span style="color:  #e91e63; font-weight:bold; margin-left: 5px">{{ $category1->articles->where('status','Published')->count() }}</span>
                    {{--   <span class="badge">8</span> --}}
                    {{-- <span class="badge-custom float-right count-post"><h6></h6></span> --}}
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="widget my-4">
            <div class="widget-heading text-center"><h3>Bảng giá mới nhất</h3></div>
            <div class="card widget-body">
                <ul class="list-group widget-style">
                    @foreach ($articlesm as $k => $article)
                    <li class="list-group-item">
                        <h3><a href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html' }}" title="{{ $article->title }}"><i class="ti-arrow-right"></i> {{ $article->name}}</a></h3>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="widget my-4">
            <div class="widget-heading text-center"><h3>Bảng giá xem nhiều</h3></div>
            <div class="card widget-body">
                <ul class="list-group widget-style">
                    @foreach ($articlesview as $k => $article)
                    <li class="list-group-item">
                        <h3><a href="{{ route('frontend.home.index') }}/{{ $article->slug.'.html' }}" title="{{ $article->title }}"><i class="ti-arrow-right"></i> {{ $article->name}}</a></h3><span class="view-count"><i class="ti-eye"></i> {{ $article->view_count }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Side Widget -->
{{--         <div class="widget my-4">
            <div class="widget-heading text-center"><h3>Liên kết</h3></div>
            <div class="card list-group-item">
                <div class="card-body-content">Hello World!</div>
            </div>
        </div> --}}
    </aside>
</div>
</div>