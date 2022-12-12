@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
    $("#keywords").val(this.value);
    $("#description").val(this.value);
  });
</script>
<script>
  var editor = CKEDITOR.replace( 'content' );
  CKFinder.setupCKEditor( editor );
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name', function() {
      var slugwm = CreateSlugE($(this).val());
      $('div#slugwm').text('{{ $setting->web }}/huong-dan/'+slugwm+'.html');
    });
  });
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugwm = CreateSlugE($(this).val());
      $('div#slugwm').text('{{ $setting->web }}/huong-dan/'+slugwm+'.html');
    });
  });
  function CreateSlugE(text)
  {
    return text.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
    .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
    .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
    .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
    .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
    .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
    .replace(/đ/gi, 'd')
    .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
    .replace(/\-\-\-\-\-/gi, '-')
    .replace(/\-\-\-\-/gi, '-')
    .replace(/\-\-\-/gi, '-')
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, ''); // Trim - from end of text
  }
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thêm mới Bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hướng dẫn</a></li>
      <li><a href="{{ route('backend.tutorial.index') }}">Quản lý Hướng dẫn</a></li>
      <li class="active">Thêm</li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.tutorial.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="webmail">
              <div class="form-group">
                <label>Tên bài viết</label>
                <input type="text" name="name" id="name" onkeyup="AutoSlug();" value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết">
              </div>
              <div class="form-group">
                <label>Mô tả bài viết</label>
                <textarea class="form-control" name="descriptions" id="descriptions" onchange="getDescription()" value="{{ old('descriptions') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết">{{ old('descriptions') }}</textarea>
              </div>
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="hide_show" id="hide_show" value="1" class="minimal" checked="1"><span style="margin-left: 10px;">Hiển thị</span>
                </label>
              </div> --}}
              <div class="form-group">
                <label>Nội dung bài viết</label>
                <textarea class="form-control" name="content" id="content" rows="3">{!! old('content') !!}</textarea>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slugwm"></div>
                  <div class="title-seo" id="title1"></div>
                  <div class="description-seo" id="descriptions1"></div>
                  <label>URL bài viết</label>
                  <input type="text" type="text" name="slug" id="slug" {{-- oninput="getUrl()" --}} onchange="getUrl()" value="{{ old('slug') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL bài viết">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="{{ old('keywords') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết">{{ old('keywords') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết">{{ old('description') }}</textarea>
                </div>
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
              <a href="{{ route('backend.tutorial.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>Hình ảnh đại diện</label>
          </div>
          <div class="box-body">
            <div class="form-group">
              <input type="file" name="img" class="form-control">
            </div>
          </div>
        </div>
        {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  <option value="Published" selected="selected">Xuất bản</option>
                  <option value="Pending">Chờ duyệt</option>
                </select>
              </div>
            </div>
          </div> --}}
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>Số thứ tự</label>
          </div>
          <div class="box-body">
            <div class="form-group">
              <input type="number" name="stt" id="stt" value="1" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>
              <input type="checkbox" name="hide_show" id="hide_show" value="1" class="minimal" checked="1"><span style="margin-left: 10px;">Hiển thị</span>
            </label>
          </div>
        </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <label>Thao tác</label>
        </div>
        <div class="box-body">
          <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
          <a href="{{ route('backend.tutorial.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
        </div>
      </div>
    </div>
    <!-- right column -->
  </div>
</section>
</div>
</form>
@endsection