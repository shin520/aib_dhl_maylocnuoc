@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Cập nhật Newsletter
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Liên hệ</a></li>
      <li><a href="{{ route('newsletter.index') }}">Quản lý Newsletter</a></li>
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
    <form method="POST" action="{{ route('newsletter.update', $newsletter->id) }}">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Email Newsletter</label>
                <input type="text" name="email" id="email" value="@if(isset($newsletter->email)){{ old('email', $newsletter->email) }}@else{{ old('email') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập email Khách Hàng">
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <textarea class="form-control" name="note" id="note" value="@if(isset($newsletter->note)){{ old('note', $newsletter->note) }}@else{{ old('note') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập ghi chú">@if(isset($newsletter->note)){{ old('note', $newsletter->note) }}@else{{ old('note') }}@endif</textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
            <label>
              <input type="checkbox" name="read" id="read" value="1" {{ $newsletter->read == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px">Xác nhận</span>
            </label>
          </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($newsletter->stt)){{ old('stt', $newsletter->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('newsletter.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection