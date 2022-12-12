@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-4 main-content">
        <nav aria-label="breadcrumb" style="margin-top: 46px">
          <ol class="breadcrumb shadow-sm">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $contacts->name }}</li>
          </ol>
        </nav>
        <article class="card shadow post">
          <div class="post-content">
            <div class="main-title">
              <h1 class="title">{{ $contacts->name }}</h1>
            </div>
            <h2 style="position:absolute; top:-1000px;">{{ $contacts->name }}</h2>
            <h3 style="position:absolute; top:-1000px;">{{ $contacts->name }}</h3>
            {{-- <div class="fb-like" data-href="{{ route('frontend.contact.index') }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
            <hr>
            <p>{!! $contacts->content !!}</p>
            <hr>
            {{-- <div class="fb-like" data-href="{{ route('frontend.contact.index') }}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> --}}
            <form action="{{ route('backend.contactform.store') }}" method="POST" accept-charset="utf-8">
              @csrf
              <div class="modal-body" style="padding: 0px;">
                @if (Session::has('success'))
                <div class="alert-custom">
                  <div class="alert alert-success">{{ Session::get('success') }}</div>
                </div>
                @endif
                <input type="hidden" id="type" name="type" value="contactform">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                    <input class="form-control" name="name" id="name" placeholder="Họ và tên" type="text" required />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                    <input class="form-control" name="address" id="address" placeholder="Địa chỉ" type="text" required />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                    <input class="form-control" name="phone" id="phone" placeholder="Số điện thoại" type="text" required {{-- autofocus --}} />
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                    <input class="form-control" name="email" id="email" placeholder="Email" type="email" required />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                    <input class="form-control" name="subject" id="subject" placeholder="Chủ đề" type="text" required />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <textarea style="resize:vertical;" class="form-control" placeholder="Nội dung" rows="6" name="contactcontent" id="contactcontent" required></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                    <input type="hidden" class="form-control" name="stt" id="stt" value="1" placeholder="Chủ đề"required />
                  </div>
                </div>
                <div class="panel-footer mt-3 mb-3" style="margin-bottom:-14px;">
                  <input type="submit" id="send_contact" class="btn btn-success btn-custom" value="Gửi"/>
                  <!--<span class="glyphicon glyphicon-ok"></span>-->
                  <input type="reset" class="btn btn-danger btn-custom" value="Xóa"/>
                  <!--<span class="glyphicon glyphicon-remove"></span>-->
                </div>
              </div>
            </form>
            <hr>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="office-1" data-toggle="tab" href="#office" title="Bản đồ" role="tab" aria-controls="office" aria-selected="true">Bản đồ chỉ đường</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-1">{!! $setting->maps !!}</div>
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
            {{-- <div class="fb-comments" data-href="{{ route('frontend.contact.index') }}" data-width="100%" data-numposts="5"></div> --}}
          </div>
          </div>
      </div>
    </article>
    @endsection
    @push("style")
    @endpush
    @push("script")
    {{-- <script>
      var msg = '{{ Session::get('Swal.fire') }}';
      var exist = '{{ Session::has('Swal.fire') }}';
      if(exist){
        $("#send_contact").click(function () {
            Swal.fire(
            'Gửi thông tin liên hệ thành công !',
            'Chân thành Cảm ơn Quý khách !',
            'success');
        });
        
      }
    </script> --}}

     {{-- <script>
          var msg = '{{ Session::get('Swal.fire') }}';
          var exist = '{{ Session::has('Swal.fire') }}';
          if(exist){
            $("#send_email").click(function () {
                Swal.fire(
                'Gửi thông tin liên hệ thành công !',
                'Cảm ơn Quý khách !',
                'success');
            });
            
          }
    </script> --}}
    <script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $contacts->name }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":"ImageObject","@id":"{{ route('frontend.contact.index') }}#primaryimage","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80},{"@type":["WebPage","ContactPage"],"@id":"{{ route('frontend.contact.index') }}#webpage","url":"{{ route('frontend.contact.index') }}","inLanguage":"{{ $setting->lang }}","name":"{{ $contacts->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"primaryImageOfPage":{"@id":"{{ route('frontend.contact.index') }}#primaryimage"},"datePublished":"{{ $contacts->created_at }}","dateModified":"{{ $contacts->updated_at }}","description":"{{ $contacts->descriptions }}","breadcrumb":{"@id":"{{ route('frontend.contact.index') }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ route('frontend.contact.index') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.contact.index') }}","url":"{{ route('frontend.contact.index') }}","name":"{{ $contacts->name }}"}}]}]}</script>
    @endpush