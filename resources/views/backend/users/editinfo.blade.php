@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Chỉnh sửa thông tin User
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>User</a></li>
      {{-- <li><a href="{{ route('backend.dashboard.index') }}">Quản lý User</a></li> --}}
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
    <form method="POST" action="{{ route('backend.user.updateinfo', $user->id) }}" enctype="multipart/form-data">
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
            <div class="box-body">
              <div class="form-group">
                <label>Tên thành viên</label>
                <input type="text" name="name" value="@if(isset($user->name)){{ old('name', $user->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên thành viên">
              </div>
              <div class="form-group">
                <label>Email thành viên</label>
                <input type="email" name="email" value="@if(isset($user->email)){{ old('email', $user->email) }}@else{{ old('email') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập email thành viên">
              </div>
              <div class="form-group">
                <label>Mô tả thành viên</label>
                <textarea class="form-control" name="content" id="content" value="@if(isset($user->content)){!! old('content', $user->content) !!}@else{!! old('content') !!}@endif" rows="3">@if(isset($user->content)){!! old('content', $user->content) !!}@else{!! old('content') !!}@endif</textarea>
              </div>
              <script>
                var editor = CKEDITOR.replace( 'content' );
                CKFinder.setupCKEditor( editor );
              </script>
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
              <button class="btn btn-primary" ><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger" ><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $user->img }}" alt="{{ $user->name }}">
                <input type="file" name="img" class="form-control" value="{{ $user->img }}">
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
                  @php
                  if ($user->status == 1) {
                    echo '<option value="1" selected>Active</option>';
                    echo '<option value="0">UnActive</option>';
                  } else {
                    echo '<option value="0" selected>UnActive</option>';
                    echo '<option value="1">Active</option>';
                  }
                  @endphp
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
                <input type="number" name="stt" id="stt" value="@if(isset($user->stt)){{ old('stt', $user->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary" ><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger" ><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection