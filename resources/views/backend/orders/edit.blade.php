@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Cập nhật Đơn hàng
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Đơn hàng</a></li>
      <li><a href="{{ route('backend.order.index') }}">Quản lý Đơn hàng</a></li>
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
    <form method="POST" action="{{ route('backend.order.update', $order_detail->id) }}">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Thông tin Khách hàng</h4>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label>Mã Đơn hàng</label>
                <input type="text" name="id" value="{{ $order_detail->id }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Mã Đơn hàng" disabled>
              </div>
              <div class="form-group">
                <label>Tên Khách hàng</label>
                <input type="text" name="name" id="name" value="@if(isset($order_detail->name)){{ old('name', $order_detail->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Khách hàng">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Điện thoại Khách hàng</label>
                    <input type="text" name="phone" id="phone" value="@if(isset($order_detail->phone)){{ old('phone', $order_detail->phone) }}@else{{ old('phone') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập số điện thoại Khách hàng">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email Khách hàng</label>
                    <input type="text" name="email" id="email" value="@if(isset($order_detail->email)){{ old('email', $order_detail->email) }}@else{{ old('email') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập email Khách hàng">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" id="address" value="@if(isset($order_detail->address)){{ old('address', $order_detail->address) }}@else{{ old('address') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập địa chỉ Khách hàng">
              </div>
              <div class="form-group">
                <label>Ghi chú</label>
                <textarea class="form-control" name="order_note" id="order_note" value="@if(isset($order_detail->order_note)){{ old('order_note', $order_detail->order_note) }}@else{{ old('order_note') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập ghi chú">@if(isset($order_detail->order_note)){{ old('order_note', $order_detail->order_note) }}@else{{ old('order_note') }}@endif</textarea>
              </div>
              <div class="form-group">
                <label>Ghi chú Admin</label>
                <textarea class="form-control" name="order_note_admin" id="order_note_admin" value="@if(isset($order_detail->order_note_admin)){{ old('order_note_admin', $order_detail->order_note_admin) }}@else{{ old('order_note_admin') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập ghi chú">@if(isset($order_detail->order_note_admin)){{ old('order_note_admin', $order_detail->order_note_admin) }}@else{{ old('order_note_admin') }}@endif</textarea>
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Chi tiết Đơn hàng</h4>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $total_items = 0
                  @endphp
                  @foreach ($orderdetails as $orderdetail)
                  <tr>
                    <td><strong>Tên sản phẩm</strong></td>
                    <td><img src="/storage/uploads/{{ $orderdetail['img'] }}" class="img-thumbnail" style="max-width: 50px"></td>
                    <td>{{ $orderdetail->quantity }}</td>
                    <td>{{ product_price_view($orderdetail->price) }}₫</td>
                    <td>{{ product_price_view($orderdetail->total_item) }}₫</td>
                    <td>
                      <a data-toggle="tooltip" class="delete-item btn btn-danger" data-id="{{ $orderdetail->id }}" data-placement="top" title="Xoá"><i class="fa fa-trash"></i>
                    </td>
                  </tr>
                  @php
                    $total_items += $orderdetail->total_item
                  @endphp
                  @endforeach
                </tbody>
              </table>
              <div class="total alert alert-success" style="margin-top: 10px;"><strong>Tổng tiền:</strong> {{ product_price_view($total_items) }}₫</div>
            </div>
          </div>
        </div>
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Tình trạng</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                  @if($order_detail->status == 1)
                  <option selected="selected" disabled="disabled" value="1">Mới đặt</option>
                  <option value="2">Đã xác nhận</option>
                  <option value="3">Đang giao</option>
                  <option value="4">Đã giao</option>
                  <option value="5">Đã hủy</option>
                  @elseif($order_detail->status == 2)
                  <option selected="selected" disabled="disabled" value="2">Đã xác nhận</option>
                  <option value="1">Mới đặt</option>
                  <option value="3">Đang giao</option>
                  <option value="4">Đã giao</option>
                  <option value="5">Đã hủy</option>
                  @elseif($order_detail->status == 3)
                  <option selected="selected" disabled="disabled" value="3">Đang giao</option>
                  <option value="1">Mới đặt</option>
                  <option value="2">Đã xác nhận</option>
                  <option value="4">Đã giao</option>
                  <option value="5">Đã hủy</option>
                  @elseif($order_detail->status == 4)
                  <option selected="selected" disabled="disabled" value="4">Đã giao</option>
                  <option value="1">Mới đặt</option>
                  <option value="2">Đã xác nhận</option>
                  <option value="3">Đang giao</option>
                  <option value="5">Đã hủy</option>
                  @else
                  <option selected="selected" disabled="disabled" value="5">Đã hủy</option>
                  <option value="1">Mới đặt</option>
                  <option value="2">Đã xác nhận</option>
                  <option value="3">Đang giao</option>
                  <option value="4">Đã giao</option>
                  @endif
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
                <input type="number" name="stt" id="stt" value="@if(isset($order_detail->stt)){{ old('stt', $order_detail->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.order.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection
@push('script')
<script>
  $(".delete-item").click(function(e){
      e.preventDefault();
      var id = $(this).data("id");
      // alert(id);
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax(
      {
          url: "/administrator/orders/"+id+"/destroyorderdetail",
          type: 'DELETE',
          data: {
              "id": id,
              "_token": token,
          },
            success: function (data) {
            if (data['status']==true) { // if true (1)
            setTimeout(function(){ // wait for 3 secs(2)
            location.reload(); // then reload the page.(3)
            }, 1000);
            alert(data['message']);
            } else {
            alert('Rất tiếc, đã có lỗi xảy ra !');
            }
            },
            error: function (data) {
            alert(data.responseText);
            }
      });
  });
</script>
@endpush