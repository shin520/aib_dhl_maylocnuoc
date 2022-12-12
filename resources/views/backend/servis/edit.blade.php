@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ $setting->web }}/dich-vu/'+slug1+'.html');
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
    Chỉnh sửa Bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Tin tức</a></li>
      <li><a href="{{ route('backend.servi.index') }}">Quản lý Tin tức</a></li>
      <li class="active">Sửa</li>
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
    <form method="POST" action="{{ route('backend.servi.update', $servi->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="servi">
              <div class="form-group">
                <label>Tên bài viết</label>
                <input type="text" name="name" id="name" value="@if(isset($servi->name)){{ old('name', $servi->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết">
                {{--  @if(isset($news->name)){{ old('name', $news->name) }}@else{{old('name')}}@endif --}}
              </div>
              <div class="form-group">
                <label>Mô tả bài viết</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($servi->descriptions)){{ old('descriptions', $servi->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết">@if(isset($servi->descriptions)){{ old('descriptions', $servi->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $servi->is_featured == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
                </label>
              </div> --}}
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $servi->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
                </label>
              </div> --}}
              <div class="form-group">
                <label>Nội dung bài viết</label>
                <textarea class="form-control" name="content" id="content" rows="3">@if(isset($servi->content)){{ old('content', $servi->content) }}@else{{ old('content') }}@endif</textarea>
              </div>
              {{-- <script>
                  CKEDITOR.replace('content');
              </script> --}}
              <script>
                var editor = CKEDITOR.replace( 'content' );
                CKFinder.setupCKEditor( editor );
              </script>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slug1">{{ $setting->web }}/dich-vu/{{ $servi->slug }}.html</div>
                  <div class="title-seo" id="title1">{{ $servi->title }}</div>
                  <div class="description-seo" id="descriptions1">{{ $servi->descriptions }}</div>
                  <label>URL bài viết</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($servi->slug)){{ old('slug', $servi->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL bài viết">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="@if(isset($servi->title)){{ old('title', $servi->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($servi->keywords)){{ old('keywords', $servi->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết">@if(isset($servi->keywords)){{ old('keywords', $servi->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($servi->description)){{ old('description', $servi->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết">@if(isset($servi->description)){{ old('description', $servi->description) }}@else{{ old('description') }}@endif</textarea>
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
              <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $servi->img }}" alt="{{ $servi->name }}">
                <input type="file" name="img" class="form-control" value="{{ $servi->img }}">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($servi->stt)){{ old('stt', $servi->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $servi->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection