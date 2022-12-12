@extends('backend.layout.master')
@push('script')
{{-- <script>
$("#name").keyup(function(){
$("#title").val(this.value);
$("#keywords").val(this.value);
$("#description").val(this.value);
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
    Thêm mới hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.slider.index') }}">Quản lý hình ảnh</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.slider.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="slider">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="img" class="form-control">
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
    Thêm mới hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.social.index') }}">Quản lý hình ảnh</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.social.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="social">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Nhập icon</label>
                <textarea class="form-control" name="icon" id="icon" value="{{ old('icon') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập class icon">{{ old('icon') }}</textarea>
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="img" class="form-control">
              </div>
            </div>
          </div> --}}
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
    Thêm mới hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.other.index') }}">Quản lý hình ảnh</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.other.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="other">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề hình ảnh">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Link liên kết</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link liên kết">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="img" class="form-control">
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
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endif
@endsection