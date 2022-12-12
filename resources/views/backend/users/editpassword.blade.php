@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Thay đổi mật khẩu User
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>User</a></li>
      <!-- <li><a href="{{ route('backend.dashboard.index') }}">Quản lý User</a></li> -->
      <li class="active">Đổi mật khẩu</li>
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
    <form method="POST" action="{{ route('backend.user.updatepassword', $user->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">

              <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập mật khẩu cũ">
              </div>
              <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập mật khẩu mới">
              </div>
              <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập lại mật khẩu mới">
              </div>
              <button class="btn btn-primary" ><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger" ><i class="fa fa-times-circle"></i> Thoát</a>
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
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection