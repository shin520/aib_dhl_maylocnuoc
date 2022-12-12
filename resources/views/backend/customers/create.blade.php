@extends('backend.layout.master')
@push('script')
<script>
  CKEDITOR.replace('descriptions', {
    filebrowserBrowseUrl: '{{ asset('/backend/plugins/ckfinder/ckfinder.html') }}',
    filebrowserImageBrowseUrl: '{{ asset('/backend/plugins/ckfinder/ckfinder.html?type=Images') }}',
    filebrowserFlashBrowseUrl: '{{ asset('/backend/plugins/ckfinder/ckfinder.html?type=Flash') }}',
    filebrowserUploadUrl: '{{ asset('/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
    filebrowserImageUploadUrl: '{{ asset('/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
    filebrowserFlashUploadUrl: '{{ asset('/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
  } );
</script>
@endpush
@php
  $segment2 = Request::segment(2);
@endphp
@section('content')
<!-- Content Wrapper. Contains page content -->
@if($segment2 == 'customers')
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thêm mới Bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Ý kiến Khách hàng</a></li>
      <li><a href="{{ route('backend.customer.index') }}">Quản lý Ý kiến</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.customer.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="customer">
              <div class="form-group">
                <label>Tên Khách hàng</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Khách hàng">
              </div>
              <div class="form-group">
                <label>Chức vụ</label>
                <input type="text" name="work" id="work" value="{{ old('work') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập chức vụ Khách hàng">
              </div>
              <div class="form-group">
                <label>Ý kiến Khách hàng</label>
                <textarea class="form-control" name="descriptions" id="descriptions" onchange="getDescription()" value="{{ old('descriptions') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập Ý kiến của Khách hàng">{{ old('descriptions') }}</textarea>
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
              <a href="{{ route('backend.customer.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
        <div class="box box-primary">
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <label>Thao tác</label>
        </div>
        <div class="box-body">
          <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
          <a href="{{ route('backend.customer.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
        </div>
      </div>
    </div>
    <!-- right column -->
  </div>
</section>
</div>
</form>
@elseif($segment2 == 'whys')
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thêm mới Bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Vì sao Chọn</a></li>
      <li><a href="{{ route('backend.why.index') }}">Quản lý vì sao Chọn</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.why.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="why">
              <div class="form-group">
                <label>Tên bài viết</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết">
              </div>
              <div class="form-group">
                <label>Nội dung bài viết</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="{{ old('descriptions') }}">{{ old('descriptions') }}</textarea>
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
              <a href="{{ route('backend.why.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
        <div class="box box-primary">
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <label>Thao tác</label>
        </div>
        <div class="box-body">
          <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
          <a href="{{ route('backend.why.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
        </div>
      </div>
    </div>
    <!-- right column -->
  </div>
</section>
</div>
</form>
@endif
@endsection