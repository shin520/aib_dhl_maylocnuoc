@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Đơn hàng
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      {{-- <li><a>Đơn hàng</a></li> --}}
      <li><a href="{{ route('backend.order.index') }}">Quản lý Đơn hàng</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
<section class="content" style="min-height: auto;padding-bottom: 0px">
  <form action="{{ route('backend.order.postSearchTable') }}" method="POST" class="formAjax">
    @csrf
    @method('POST')
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary" style="margin-bottom: 0">
            <div class="box-body">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                </div>
              @endif
              @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="row">
                <div class="col-md-3 text-center">
                  <div class="form-group">
                    <label>Từ ngày</label>
                    <input type="date" name="fromday" value="{{ old('fromday') }}" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ngày bắt đầu">
                  </div>
                </div>
                <div class="col-md-3 text-center">
                  <div class="form-group">
                    <label>Đến ngày</label>
                    <input type="date" name="today" value="{{ old('today') }}" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Ngày kết thúc">
                  </div>
                </div>
                <div class="col-md-3 text-center">
                  <div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Tình trạng">
                    <label>Tình trạng</label>
                    <select class="form-control select2" id="status" name="status" style="width: 100%;">
                      <option value="">Chọn tình trạng</option>
                      <option value="1" {{ old('status') == 1 ? 'selected="selected"' : '' }}>Mới đặt</option>
                      <option value="2" {{ old('status') == 2 ? 'selected="selected"' : '' }}>Đã xác nhận</option>
                      <option value="3" {{ old('status') == 3 ? 'selected="selected"' : '' }}>Đang giao</option>
                      <option value="4" {{ old('status') == 4 ? 'selected="selected"' : '' }}>Đã giao</option>
                      <option value="5" {{ old('status') == 5 ? 'selected="selected"' : '' }}>Đã hủy</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3 text-center">
                  <div class="form-group">
                    <label>Thao tác</label>
                    <button type="submit" class="form-control btn btn-success search-order-form"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">
            <table id="orders" class="table table-bordered table-striped set__width">
              <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên</th>
                  <th>Điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Số tiền</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $k => $order)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox" data-id="{{ $order->id }}">
                    </label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" data-id="{{ $order->id }}" value="@if(isset($order->stt)){{ old('stt', $order->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                    </div>
                  </td>
                  <td>{{ $order->id }}</td>
                  <td><strong><a href="{{ route('backend.order.edit', $order->id) }}">{{ $order->name }}</a></strong></td>
                  <td>{{ $order->phone }}</td>
                  <td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
                  <td>{{ product_price_view($order->orderdetails->sum('total_item')) }}₫
                  </td>
                  <td>
                    <div class="
                      @php
                        if ($order->status == 1) {
                        echo 'badge bg-yellow';
                        }elseif($order->status == 2) {
                          echo "badge bg-aqua";
                        }elseif($order->status == 3) {
                          echo "badge bg-teal";
                        }elseif($order->status == 4) {
                          echo "badge bg-green";
                        }else{
                          echo "badge bg-red";
                        }
                      @endphp">
                      @php
                        if ($order->status == 1) {
                          echo 'Mới đặt';
                        }elseif($order->status == 2) {
                          echo "Đã xác nhận";
                        }elseif($order->status == 3) {
                          echo "Đang giao";
                        }elseif($order->status == 4) {
                          echo "Đã giao";
                        }else {
                          echo "Đã hủy";
                        }
                      @endphp
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa Đơn hàng" href="{{ route('backend.order.edit', $order->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.order.destroy', $order->id) }}" onclick="return confirm('Xác nhận Xóa ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá Đơn hàng"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push("script")

<script>
    function switchChange(){
    }
    $(document).ready(function(){
      switchChange();
      $(function(){
        $('#orders').on( 'change', 'input[class="stt"]', function () {
          var stt = $(this).val();
          var order_id = $(this).data('id');
          $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('backend.order.changestt') }}',
            data: {'stt': stt, 'order_id': order_id},
            success: function(data){
              console.log(data.success)
            }
          });
        })
      })
    })
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#selectall').on('click', function(e) {
     if($(this).is(':checked',true))
     {
      $(".checkbox").prop('checked', true);
    } else {
      $(".checkbox").prop('checked',false);
    }
  });
    $('.checkbox').on('click',function(){
      if($('.checkbox:checked').length == $('.checkbox').length){
        $('#selectall').prop('checked',true);
      }else{
        $('#selectall').prop('checked',false);
      }
    });
    $('.delete-all').on('click', function(e) {
      var idsArr = [];  
      $(".checkbox:checked").each(function() {  
        idsArr.push($(this).attr('data-id'));
      });  
      if(idsArr.length <=0)
      {  
        alert("Vui lòng chọn ít nhất 1 Đơn hàng để Xóa !");  
      }  else {  
        if(confirm("Bạn có chắc chắn, Xóa tất cả Đơn hàng đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.order.deletemultiple') }}",
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids='+strIds,
            success: function (data) {
            if (data['status']==true) { // if true (1)
              setTimeout(function(){ // wait for 3 secs(2)
                location.reload(); // then reload the page.(3)
              }, 3000); 
              $(".checkbox:checked").each(function() {  
                $(this).parents("tr").remove();
              });
                alert(data['message']);
              } else {
                alert('Rất tiếc, đã có lỗi xảy ra !');
              }
            },
            error: function (data) {
              alert(data.responseText);
            }
          });
        }  
      }  
    });
  });
</script>

@endpush