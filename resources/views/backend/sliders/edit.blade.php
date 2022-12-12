@extends('backend.layout.master')
@push('script')
{{-- <script>
$("#name").keyup(function(){
$("#slug").val(this.value);
$("#title").val(this.value);
});
</script> --}}
@endpush
@section('content')
@php
  $segment2 = Request::segment(2);
@endphp
@if($segment2 == 'slider')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Chỉnh sửa hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.slider.index') }}">Quản lý hình ảnh</a></li>
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
    <form method="POST" action="{{ route('backend.slider.update', $slider->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="slider">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="@if(isset($slider->title)){{ old('title', $slider->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="@if(isset($slider->url)){{ old('url', $slider->url) }}@else{{ old('url') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="img" class="form-control" value="{{ $slider->img }}">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-top:10px;" src="/storage/uploads/{{ $slider->img }}" alt="{{ $slider->name }}">
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
              <a href="{{ route('backend.slider.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $slider->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($slider->status == 'Published') {
                  echo '<option value="Published" selected>Xuất bản</option>';
                  echo '<option value="Pending">Chờ duyệt</option>';
                  }else {
                  echo '<option value="Pending" selected>Chờ duyệt</option>';
                  echo '<option value="Published">Xuất bản</option>';
                  }
                  @endphp
                </select>
              </div>
            </div>
          </div> --}}
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@elseif($segment2 == 'social')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Chỉnh sửa hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.social.index') }}">Quản lý hình ảnh</a></li>
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
    <form method="POST" action="{{ route('backend.social.update', $slider->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="social">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="@if(isset($slider->title)){{ old('title', $slider->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="@if(isset($slider->url)){{ old('url', $slider->url) }}@else{{ old('url') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Nhập icon</label>
                <textarea class="form-control" name="icon" id="icon" value="@if(isset($slider->icon)){{ old('icon', $slider->icon) }}@else{{ old('icon') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập class icon">@if(isset($slider->icon)){{ old('icon', $slider->icon) }}@else{{ old('icon') }}@endif</textarea>
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
              <a href="{{ route('backend.social.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $slider->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($slider->status == 'Published') {
                  echo '<option value="Published" selected>Xuất bản</option>';
                  echo '<option value="Pending">Chờ duyệt</option>';
                  }else {
                  echo '<option value="Pending" selected>Chờ duyệt</option>';
                  echo '<option value="Published">Xuất bản</option>';
                  }
                  @endphp
                </select>
              </div>
            </div>
          </div> --}}
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@else($segment2 == 'other')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Chỉnh sửa hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.other.index') }}">Quản lý hình ảnh</a></li>
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
    <form method="POST" action="{{ route('backend.other.update', $slider->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="other">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="@if(isset($slider->title)){{ old('title', $slider->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="@if(isset($slider->url)){{ old('url', $slider->url) }}@else{{ old('url') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="img" class="form-control" value="{{ $slider->img }}">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-top:10px;" src="/storage/uploads/{{ $slider->img }}" alt="{{ $slider->name }}">
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
              <a href="{{ route('backend.other.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $slider->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($slider->status == 'Published') {
                  echo '<option value="Published" selected>Xuất bản</option>';
                  echo '<option value="Pending">Chờ duyệt</option>';
                  }else {
                  echo '<option value="Pending" selected>Chờ duyệt</option>';
                  echo '<option value="Published">Xuất bản</option>';
                  }
                  @endphp
                </select>
              </div>
            </div>
          </div> --}}
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endif
@endsection