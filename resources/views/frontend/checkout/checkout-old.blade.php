@extends("frontend.layout.master-layout")
@section("content")
<div class="container">
  <nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->title }}"><i class="ti-home"></i> Trang chủ</a></li>
      <li class="breadcrumb-item">Giỏ hàng</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="">Thông tin đặt hàng</a></li>
    </ol>
  </nav>
  <div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
  <article class="card shadow post">
    <div class="post-content">
    <div class="hosting-price" id="post_content">
    	@if ($errors->any())
    	<div class="alert alert-danger">
    	  <ul>
    	    @foreach ($errors->all() as $error)
    	    <li>{{ $error }}</li>
    	    @endforeach
    	  </ul>
    	</div>
    	@endif
      <div class="main-title text-center">
        <h1 class="title" >
        <a href="{{ URL::current() }}" title="Thông tin đặt hàng" style="font-weight: bold;">Thông tin đặt hàng</a>
        </h1>
      </div>
      <h2 style="position:absolute; top:-1000px;">Thông tin đặt hàng</h2>
      <h3 style="position:absolute; top:-1000px;">Thông tin đặt hàng</h3>
      <hr>
      <div class="container">
          <div class="row">
          		<div class="col-md-5">
          			<form class="form" action="" method="POST">
          				@csrf
          				<div class="form-group">
          					<label>Tên</label>
          					<input type="text" name="name" value="{{ Auth::guard('account')->user()->name }}" class="form-control" placeholder="Nhập email">
          				</div>
          				<div class="form-group">
          					<label>Email</label>
          					<input type="email" name="email" value="{{ Auth::guard('account')->user()->email }}" class="form-control" placeholder="Nhập email">
          				</div>
          				<div class="form-group">
          					<label>Số điện thoại</label>
          					<input type="text" name="phone" value="{{ Auth::guard('account')->user()->phone }}" class="form-control" placeholder="Nhập số điện thoại">
          				</div>
          				<div class="form-group">
          					<label>Địa chỉ</label>
          					<input type="text" name="address" value="{{ Auth::guard('account')->user()->address }}" class="form-control" placeholder="Nhập địa chỉ">
          				</div>
          				{{-- <div class="form-group">
          					<label for="province">Tỉnh/Thành phố<span class="text-danger"> (*)</span></label>
          					<select class="form-control" name="province" id="province" required>
          						<option>Chọn Tỉnh/Thành phố</option>
          						@foreach($provinces as $province)
          						<option value="{{ $province->id }}|{{ $province->name }}">{{ $province->name }}</option>
          						@endforeach
          					</select>
          				</div>
          				<div class="form-group">
          					<label for="district">Quận/Huyện<span class="text-danger"> (*)</span></label>
          					<select class="form-control" name="district" id="district" required>
          					</select>
          				</div>
          				<div class="form-group">
          				    <label for="ward">Phường/Xã<span class="text-danger"> (*)</span></label>
          				    <select class="form-control" name="ward" id="ward" required>
          				    </select>
          				</div> --}}
          				<div class="form-group">
          					<label>Ghi chú</label>
          					<textarea name="order_note" class="form-control" placeholder="Nhập địa chỉ">
          					</textarea>
          				</div>
          				<button type="submit" class="btn btn-success btn-custom mb-3">Xác nhận</button>
          				</form>
          				<form action="" method="get" accept-charset="utf-8">
          					@csrf
          					<div class="form-group">
          					  <label>Tỉnh/Thành phố</label>
          					  <select class="form-control select2 choose province" name="province" id="province" style="width: 100%;">
          					    <option value="">Chọn Tỉnh/Thành phố</option>
          					    @foreach($provinces as $key => $province)
          					    <option value="{{ $province->id }}">{{ $province->name }}</option>
          					    @endforeach
          					  </select>
          					</div>
          					<div class="form-group">
          					  <label>Quận/Huyện</label>
          					  <select class="form-control select2 choose district" name="district" id="district" style="width: 100%;">
          					    <option value="">Chọn Quận/Huyện</option>
          					    {{-- <option value="">{{ $cart->district }}</option> --}}
          					  </select>
          					</div>
          					  <div class="form-group">
          					    <label>Phường/Xã</label>
          					    <select class="form-control select2 ward" name="ward" id="ward" style="width: 100%;">
          					      <option value="">Chọn Phường/Xã</option>
          					    </select>
          					  </div>
          					<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-danger btn-custom calculate_delivery">
          				</form>
          				{{-- @php
          					echo Session::get('fee');
          				@endphp --}}
          		</div>
          		<div class="col-md-7">
          			<table class="table table-striped table-inverse table-hover">
          			    <thead>
          			        <tr>
          			            <th>STT</th>
          			            <th>Tên sản phẩm</th>
          			            <th>Giá</th>
          			            <th>Số lượng</th>
          			            <th>Thành tiền</th>
          			        </tr>
          			    </thead>
          			    <tbody>
          			        @php
          			            $n = 1;
          			        @endphp
          			        @foreach($order->items as $item)
          			        <tr>
          			            <td>{{ $n }}</td>
          			            <td>{{ $item['name'] }}</td>
          			            <td>{{ number_format($item['sale_price']) }}₫</td>
          			            <td>{{ $item['quantity'] }}</td>
          			            <td>{{ number_format($item['quantity']*$item['sale_price']) }}₫</td>
          			        </tr>
          			        @php
          			            $n++;
          			        @endphp
          			        @endforeach
          			    </tbody>
          			</table>
          			<div class="alert alert-success">
          				<strong>Tổng tiền: {{ number_format($order->total_price) }}₫</strong>
          			</div>
          			@if(Session::get('coupon'))
          						@foreach(Session::get('coupon') as $key => $cou)
          							@if($cou['condition'] == 1)
          							<div class="alert alert-info">
          								<strong>
          									Mã giảm: {{ $cou['discount'] }} % 
          									@if(Session::get('coupon'))
          										<a href="{{ route('unset_coupon') }}" title="Xóa mã giảm giá" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa mã giảm giá"><i class="fa fa-times"></i></a>
          									@endif
          								</strong>
          							</div>
          								{{-- <div class="alert alert-success">
          									
          								</div> --}}
          								<div class="alert alert-secondary">
          									<strong>Số tiền giảm:
          										@php
          											 $total_coupon = ($order->total_price*$cou['discount'])/100;
          											 echo number_format($total_coupon).'₫';
          											// echo '<strong>Tổng giảm:'.number_format($total_coupon).'₫'.'</strong>';
          										@endphp
          									</strong>
          								</div>
          								{{-- <div class="alert alert-danger">
          									<strong>Sau khi giảm: {{ number_format($order->total_price - $total_coupon) }}</strong>
          								</div> --}}
          								{{-- <div class="alert alert-danger">
          									<strong>
          										
          									</strong>
          								</div> --}}
          								@php
          								$total_after_coupon = $order->total_price - $total_coupon;
          								@endphp
          							@elseif($cou['condition'] == 2)
          								<div class="alert alert-success">
          									<strong>Mã giảm: {{ number_format($cou['discount']) }}đ
          										@if(Session::get('coupon'))
          										<a href="{{ route('unset_coupon') }}" title="Xóa mã giảm giá" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa mã giảm giá"><i class="fa fa-times"></i></a>
          										@endif
          									</strong>
          								</div>
          								<div>
          									@php
          										$total_coupon = ($order->total_price - $cou['discount']);
          										// echo '<strong>Tổng giảm:'.number_format($total_coupon).'₫'.'</strong>';
          									@endphp
          								</div>
          								{{-- <div class="alert alert-danger">
          								 	<strong>Tổng đã giảm: {{ number_format($total_coupon) }}đ</strong>
          								</div> --}}
          								@php
          								$total_after_coupon = $total_coupon;
          								@endphp
          							@endif
          							
          							<div class="alert alert-danger"><strong>Tổng tiền thanh toán:
          								@php
          									if (Session::get('fee') && !Session::get('coupon')) {
          										$total_after = $total_after_fee;
          										echo number_format($total_after).'₫';
          									}elseif(!Session::get('fee') && Session::get('coupon')){
          										$total_after = $total_after_coupon;
          										echo number_format($total_after).'₫';
          									}elseif(Session::get('fee') && Session::get('coupon')){
          										$total_after = $total_after_coupon;
          										$total_after = $total_after - Session::get('fee');
          										echo number_format($total_after).'₫';
          									}elseif(!Session::get('fee') && !Session::get('coupon')){
          										$total_after = $order->total_price;
          										echo number_format($total_after).'₫';
          									}
          								@endphp
          							</strong>
          							</div>
          							
          						@endforeach
          			@endif
          			@if(Session::get('fee'))
          			<div class="alert alert-warning"><strong>Phí vận chuyển: {{ number_format(Session::get('fee')) }}₫</strong> <a href="{{ route('delete.fee') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa phí vận chuyển"><i class="fa fa-times"></i></a></div>
          			@php
          			$total_after_fee = $order->total_price - Session::get('fee');
          			@endphp
          			@endif
          			{{-- <div class="alert alert-success">
          				<strong>Tổng tiền sau khi giảm: {{ number_format($order->total_price) }}₫</strong>
          			</div> --}}
          			@if (Session::has('success'))
          			<div class="alert alert-success">{{ Session::get('success') }}
          			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          			    <span aria-hidden="true">&times;</span>
          			  </button>
          			</div>
          			@elseif(Session::has('error'))
          			<div class="alert alert-danger">{{ Session::get('error') }}
          			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          			    <span aria-hidden="true">&times;</span>
          			  </button>
          			</div>
          			@endif
          			@if(Session::get('order'))
          			<form action="{{ route('check_coupon') }}" method="POST" class="form-group">
          				@csrf
          				<input type="text" name="coupon" class="form-control mb-3" placeholder="Nhập mã giảm giá">
          				<input type="submit" name="check_coupon" value="Tính mã giảm giá" class="btn btn-success form-control">
          			</form>
          			@endif
          		</div>
        
          </div>
      </div>
      </div>
  </div>
    </article>
  </div>
@endsection

@push("style")

@endpush

@push("script")
<script>
	$(document).ready(function(){
		$('.choose').on('change',function(){
		  var action  = $(this).attr('id');
		  var code_id = $(this).val();
		  var _token  = $('input[name="_token"]').val();
		  var result  = '';
		  // alert(action);
		  // alert(code_id);
		  // alert(_token);
		  if (action == 'province'){
		    result = 'district';
		  }else{
		    result = 'ward';
		  }
		  $.ajax({
		    url : '{{ route('feeship.select.home') }}',
		    method : 'POST',
		    data: {action:action,code_id:code_id,_token:_token},
		    success:function(data){
		      $('#'+result).html(data);
		    }
		  });
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.calculate_delivery').click(function(){
			var province_id = $('.province').val();
			var district_id = $('.district').val();
			var ward_id = $('.ward').val();
			var _token  = $('input[name="_token"]').val();
			if (province_id == '' && district_id == '' && ward_id == '') {
				alert('Chọn Tỉnh/Thành phố, Quận/Huyện, Phường/Xã để tính phí vận chuyển');
			}else{
				$.ajax({
				  url : '{{ route('calculate.fee') }}',
				  method : 'POST',
				  data: {province_id:province_id,district_id:district_id,ward_id:ward_id,_token:_token},
				  success:function(){
				    // $('#'+result).html(data);
				    location.reload();
				  }
				});
			}
		});
	});
</script>
@endpush

