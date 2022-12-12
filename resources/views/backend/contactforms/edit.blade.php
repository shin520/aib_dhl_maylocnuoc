@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Cập nhật Thư liên hệ
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Liên hệ</a></li>
      <li><a href="{{ route('backend.contactform.index') }}">Quản lý Thư liên hệ</a></li>
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
    <form method="POST" action="{{ route('backend.contactform.update', $contactform->id) }}">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="contactform">
              <div class="form-group">
                <label>Tên Khách Hàng</label>
                <input type="text" name="name" id="name" value="@if(isset($contactform->name)){{ old('name', $contactform->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Khách Hàng">
              </div>
              {{-- <div class="form-group">
                <label>Địa chỉ Khách Hàng</label>
                <input type="text" name="address" id="address" value="@if(isset($contactform->address)){{ old('address', $contactform->address) }}@else{{ old('address') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập địa chỉ Khách Hàng">
              </div> --}}
              <div class="form-group">
                <label>Điện thoại Khách Hàng</label>
                <input type="text" name="phone" id="phone" value="@if(isset($contactform->phone)){{ old('phone', $contactform->phone) }}@else{{ old('phone') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập số điện thoại Khách Hàng">
              </div>
              <div class="form-group">
                <label>Email Khách Hàng</label>
                <input type="text" name="email" id="email" value="@if(isset($contactform->email)){{ old('email', $contactform->email) }}@else{{ old('email') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập email Khách Hàng">
              </div>
              {{-- <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="subject" id="subject" value="@if(isset($contactform->subject)){{ old('subject', $contactform->subject) }}@else{{ old('subject') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề">
              </div> --}}
              <div class="form-group">
                <label>Nội dung liên hệ</label>
                <textarea class="form-control" name="contactcontent" id="contactcontent" value="@if(isset($contactform->contactcontent)){{ old('contactcontent', $contactform->contactcontent) }}@else{{ old('contactcontent') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập nội dung liên hệ">@if(isset($contactform->contactcontent)){{ old('contactcontent', $contactform->contactcontent) }}@else{{ old('contactcontent') }}@endif</textarea>
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <textarea class="form-control" name="note" id="note" value="@if(isset($contactform->note)){{ old('note', $contactform->note) }}@else{{ old('note') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập ghi chú">@if(isset($contactform->note)){{ old('note', $contactform->note) }}@else{{ old('note') }}@endif</textarea>
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
              <input type="checkbox" name="read" id="read" value="1" {{ $contactform->read == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px">Đã xem</span>
            </label>
          </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($contactform->stt)){{ old('stt', $contactform->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.contactform.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection