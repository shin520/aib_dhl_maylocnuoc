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
  $('document').ready(function () {
    $(document).on('change', 'input#name', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ $setting->web }}/tin-tuc/'+slug1+'.html');
    });
  });
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ $setting->web }}/tin-tuc/'+slug1+'.html');
    });
  });
  function createslug(text)
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
      Thêm mới Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Tin tức</a></li>
      <li><a href="{{ route('backend.newcategory.index') }}">Danh mục Tin tức</a></li>
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
    <form method="POST" action="{{ route('backend.newcategory.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="newcategory">
              <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" id="name" onkeyup="AutoSlug();" value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
              </div>
              <div class="form-group">
                <label>Mô tả danh mục</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="{{ old('descriptions') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục"></textarea>
              </div>
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="hide_show" id="hide_show" value="1" class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
                </label>
              </div> --}}
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="show_nav" id="show_nav" value="1" class="minimal"><span style="margin-left: 10px;">Hiển thị menu</span>
                </label>
              </div> --}}
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slug1"></div>
                  <div class="title-seo" id="title1"></div>
                  <div class="description-seo" id="descriptions1"></div>
                  <label>URL danh mục</label>
                  <input type="text" type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="{{ old('keywords') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho danh mục"></textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn danh mục"></textarea>
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
              <a href="{{ route('backend.newcategory.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <a href="{{ route('backend.newcategory.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection