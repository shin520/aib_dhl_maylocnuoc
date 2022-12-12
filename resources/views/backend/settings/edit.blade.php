@extends('backend.layout.master')
@push('script')
{{-- <script>
  $("#title").keyup(function(){
    $("#keywords").val(this.value);
    $("#description").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#title', function() {
      var title1 = ($(this).val());
      $('div#title1').text(title1);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'textarea#description', function() {
      var description = ($(this).val());
      $('div#descriptions1').text(description);
    });
  });
</script> --}}
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Cấu hình
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="#">Cấu hình Chung</a></li>
      <li class="active">Cấu hình Website</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form id="stringLengthForm" method="POST" action="{{ route('backend.setting.update') }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            @if (Session::has('success'))
            <div class="alert-custom">
              <div class="alert alert-success">{{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            @endif
            <div class="box-header with-border">
              <h3 class="box-title">Cấu hình SEO Website</h3>
            </div>
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="setting">
              <div class="form-group">
                <label>Tên Công ty</label>
                <input type="text" name="nameindex" id="nameindex" value="@if(isset($setting->nameindex)){{ old('nameindex', $setting->nameindex) }}@else{{ old('nameindex') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Công ty">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" id="title" value="@if(isset($setting->title)){{ old('title', $setting->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề Website">
              </div>
              <div class="form-group">
                <label>Keywords</label>
                <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($setting->keywords)){{ old('keywords', $setting->keywords) }}@else{{ old('keywords') }}@endif"
                  rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho Website">@if(isset($setting->keywords)){{ old('keywords', $setting->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($setting->description)){{ old('description', $setting->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả website">@if(isset($setting->description)){{ old('description', $setting->description) }}@else{{ old('description') }}@endif</textarea>
                </div>
                <div class="url-seo" id="slug1">{{ $setting->web }}</div>
                <div class="title-seo" id="title1">{{ $setting->title }}</div>
                <div class="description-seo" id="descriptions1">{{ $setting->description }}</div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cấu hình Admin</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Title Admin</label>
                  <input type="text" name="titleadmin" value="@if(isset($setting->titleadmin)){{ old('titleadmin', $setting->titleadmin) }}@else{{ old('titleadmin') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề Admin">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cấu hình thông tin Website</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Email admin</label>
                  <input type="text" name="email" value="@if(isset($setting->email)){{ old('email', $setting->email) }}@else{{old('email')}}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Email Admin">
                </div>
                <div class="form-group">
                  <label>URL Website</label>
                  <input type="text" name="website" value="@if(isset($setting->website)){{ old('website', $setting->website) }}@else{{ old('website') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Website">
                </div>
                <div class="form-group">
                  <label>Website</label>
                  <input type="text" name="web" value="@if(isset($setting->web)){{ old('web', $setting->web) }}@else{{ old('web') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên miền Website">
                </div>
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <input type="text" name="address" value="@if(isset($setting->address)){{ old('address', $setting->address) }}@else{{ old('address') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập địa chỉ">
                </div>
                <div class="form-group">
                  <label>Hotline 1</label>
                  <input type="text" name="hotline_1" value="@if(isset($setting->hotline_1)){{ old('hotline_1', $setting->hotline_1) }}@else{{ old('hotline_1') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập số hotline">
                </div>
                <div class="form-group">
                  <label>Hotline 2</label>
                  <input type="text" name="hotline_2" value="@if(isset($setting->hotline_2)){{ old('hotline_2', $setting->hotline_2) }}@else{{ old('hotline_2') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập số hotline">
                </div>
                {{-- <div class="form-group">
                  <label>Hotline 3</label>
                  <input type="text" name="hotline_3" value="@if(isset($setting->hotline_3)){{ old('hotline_3', $setting->hotline_3) }}@else{{ old('hotline_3') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập số hotline">
                </div> --}}
                <div class="form-group">
                  <label>URL hotline 1</label>
                  <input type="text" name="href_1" value="@if(isset($setting->href_1)){{ old('href_1', $setting->href_1) }}@else{{ old('href_1') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL hotline">
                </div>
                <div class="form-group">
                  <label>URL hotline 2</label>
                  <input type="text" name="href_2" value="@if(isset($setting->href_2)){{ old('href_2', $setting->href_2) }}@else{{ old('href_2') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL hotline">
                </div>
                {{-- <div class="form-group">
                  <label>URL hotline 3</label>
                  <input type="text" name="href_3" value="@if(isset($setting->href_3)){{ old('href_3', $setting->href_3) }}@else{{ old('href_3') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL hotline">
                </div> --}}
                <div class="form-group">
                  <label>Copyright</label>
                  <input type="text" name="copyright" value="@if(isset($setting->copyright)){{ old('copyright', $setting->copyright) }}@else{{ old('copyright') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập thông tin Copyright">
                </div>
                <div class="form-group">
                  <label>HTML lang</label>
                  <input type="text" name="lang" value="@if(isset($setting->lang)){{ old('lang', $setting->lang) }}@else{{ old('lang') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title=" Nhập HTML lang">
                </div>
                <div class="form-group">
                  <label>Locale</label>
                  <input type="text" name="locale" value="@if(isset($setting->locale)){{ old('locale', $setting->locale) }}@else{{ old('locale') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title=" Nhập locale">
                </div>
                <div class="form-group">
                  <label>Author</label>
                  <input type="text" name="author" value="@if(isset($setting->author)){{ old('author', $setting->author) }}@else{{ old('author') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title=" Nhập author">
                </div>
                <div class="form-group">
                  <label>Robots permission</label>
                  <input type="text" name="robots" value="@if(isset($setting->robots)){{ old('robots', $setting->robots) }}@else{{ old('robots') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title=" Nhập robots permission">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cấu hình Mạng xã hội</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>URL Facebook</label>
                  <input type="text" name="facebook" value="@if(isset($setting->facebook)){{ old('facebook', $setting->facebook) }}@else{{ old('facebook') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Facebook">
                </div>
                <div class="form-group">
                  <label>Twitter</label>
                  <input type="text" name="twitter" value="@if(isset($setting->twitter)){{ old('twitter', $setting->twitter) }}@else{{ old('twitter') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Twitter">
                </div>
                <div class="form-group">
                  <label>Youtube</label>
                  <input type="text" name="youtube" value="@if(isset($setting->youtube)){{ old('youtube', $setting->youtube) }}@else{{ old('youtube') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Youtube">
                </div>
              </div>
            </div>
            {{-- <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cấu hình Facebook Admin & App</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>UID Facebook Admin</label>
                  <input type="text" name="uidfacebookadmin" value="@if(isset($setting->uidfacebookadmin)){{ old('uidfacebookadmin', $setting->uidfacebookadmin) }}@else{{ old('uidfacebookadmin') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập UID Facebook Admin">
                </div>
                <div class="form-group">
                  <label>ID App Facebook (Messenger)</label>
                  <input type="text" name="appidfb" value="@if(isset($setting->appidfb)){{ old('appidfb', $setting->appidfb) }}@else{{ old('appidfb') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập ID App Facebook">
                </div>
              </div>
            </div> --}}
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Xác thực Website</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>ID Google Analytics</label>
                  <input type="text" name="idanalytics" value="@if(isset($setting->idanalytics)){{ old('idanalytics', $setting->idanalytics) }}@else{{old('idanalytics')}}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Thêm mã ID Google Analytics">
                </div>
                <div class="form-group">
                  <label>Google Site Verification</label>
                  <input type="text" name="googlesiteverification" value="@if(isset($setting->googlesiteverification)){{ old('googlesiteverification', $setting->googlesiteverification) }}@else{{ old('googlesiteverification') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Thêm mã Google Site Verification">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Geo Location Meta Tag</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Latitude</label>
                  <input type="text" name="latitude" value="@if(isset($setting->latitude)){{ old('latitude', $setting->latitude) }}@else{{old('latitude')}}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Thêm Latitude">
                </div>
                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="longitude" value="@if(isset($setting->longitude)){{ old('longitude', $setting->longitude) }}@else{{ old('longitude') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Thêm Longitude">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tuỳ biến Code</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Code &lt;head&gt; ... &lt;/head&gt;</label>
                  <textarea class="form-control" name="codehead" rows="3" data-toggle="tooltip" data-placement="top" title="Thêm code <head> ... </head>">@if(isset($setting->codehead)){!! old('codehead', $setting->codehead) !!}@else{!! old('codehead') !!}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Code &lt;body&gt; ... &lt;/body&gt;</label>
                  <textarea class="form-control" name="codebody" rows="3" data-toggle="tooltip" data-placement="top" title="Thêm code <body> ... </body>">@if(isset($setting->codebody)){!! old('codebody', $setting->codebody) !!}@else{!! old('codebody') !!}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Google Maps</label>
                  <textarea class="form-control" name="maps" rows="5" data-toggle="tooltip" data-placement="top" title="Thêm code Iframe Google Maps">@if(isset($setting->maps)){!! old('maps', $setting->maps) !!}@else{!! old('maps') !!}@endif</textarea>
                </div>
                {{-- <div class="form-group">
                  <label>Google Maps CN2</label>
                  <textarea class="form-control" name="maps_1" rows="3" data-toggle="tooltip" data-placement="top" title="Thêm code Iframe Google Maps">@if(isset($setting->maps_1)){!! old('maps_1', $setting->maps_1) !!}@else{!! old('maps_1') !!}@endif</textarea>
                </div> --}}
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">reCAPTCHA</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Site key</label>
                  <input class="form-control" name="site_key" rows="3" data-toggle="tooltip" data-placement="top" value="@if(isset($setting->site_key)){!! old('site_key', $setting->site_key) !!}@else{!! old('site_key') !!}@endif" title="Thêm mã site key">
                </div>
                <div class="form-group">
                  <label>Secret key</label>
                  <input class="form-control" name="secret_key" rows="3" data-toggle="tooltip" data-placement="top" value="@if(isset($setting->secret_key)){!! old('secret_key', $setting->secret_key) !!}@else{!! old('secret_key') !!}@endif" title="Thêm mã secret key">
                </div>
              </div>
            </div>
          </div>
          <!-- left column -->
          <!-- right column -->
          <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Thao tác</label>
              </div>
              <div class="box-body">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Logo trang chủ</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->logoindex }}" alt="Favicon">
                  <input type="file" name="logoindex" class="form-control" value="{{ $setting->logoindex }}">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Banner trang chủ</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->banner_index }}" alt="Favicon">
                  <input type="file" name="banner_index" class="form-control" value="{{ $setting->banner_index }}">
                  <div style="padding: 10px 15px; font-weight: normal; font-size: 12px;">Chọn ảnh có kích thước 1300 x 350</div>
                </div>
              </div>
            </div>
            {{-- <div class="box box-primary">
              <div class="box-header with-border">
                <label>Banner trang chủ</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->header }}" alt="Favicon">
                  <input type="file" name="header" class="form-control" value="{{ $setting->header }}">
                </div>
              </div>
            </div> --}}
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Favicon trang chủ</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->faviconindex }}" alt="Favicon">
                  <input type="file" name="faviconindex" class="form-control" value="{{ $setting->faviconindex }}">
                </div>
              </div>
            </div>
            {{-- <div class="box box-primary">
              <div class="box-header with-border">
                <label>Logo admin</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->logoadmin }}" alt="Favicon">
                  <input type="file" name="logoadmin" class="form-control" value="{{ $setting->logoadmin }}">
                </div>
              </div>
            </div> --}}
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Favicon admin</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->faviconadmin }}" alt="Favicon">
                  <input type="file" name="faviconadmin" class="form-control" value="{{ $setting->faviconadmin }}">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Hình ảnh Share Facebook</label>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $setting->img }}" alt="Favicon">
                  <input type="file" name="img" class="form-control" value="{{ $setting->img }}">
                </div>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <label>Thao tác</label>
              </div>
              <div class="box-body">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
            </div>
          </div>
          <!-- right column -->
        </div>
      </section>
    </div>
  </form>
  @endsection