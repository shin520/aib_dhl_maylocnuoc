@extends('frontend.layout.master-layout')

@php
    $items = Cart::getContent();
    $count_item = $items->count();
@endphp

@section('content')
<nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}"><i class="ti-home"></i> Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cart.cart') }}">Giỏ hàng</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="Thanh toán">Thanh toán</a></li>
    </ol>
</nav>
<div class="container mb-5">
@if($count_item == '')
    Giỏ hàng không có sản phẩm. Vui lòng thực hiện lại.
@else
<div class="card shadow post" style="margin: 0 auto;">
        <div class="container">
            <h2 class="mt-3 font-weight-bold text-monospace">Thanh toán</h2>
            <hr>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                    <div class="border-ship">
                    <h3 class="font-weight-bold text-monospace">Thông tin thanh toán</h3>
                    <hr>
                    <div class="col-12" style="padding: 0px;">
                        <form action="{{ route("cart.checkout.process") }}" class="needs-validation" method="POST" novalidate>
                            @csrf
                            <input type="hidden" id="stt" name="stt" value="1">
                            <input type="hidden" id="order_code" name="order_code" value="">
                            <input type="hidden" id="status" name="status" value="1">
                            <div class="form-group">
                                <label for="name">Họ và tên<span class="text-danger"> (*)</span></label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại<span class="text-danger"> (*)</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger"> (*)</span></label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Số nhà, Tên đường<span class="text-danger"> (*)</span></label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="province">Tỉnh/Thành phố<span class="text-danger"> (*)</span></label>
                                        <select class="form-control" name="province" id="province" required>
                                            <option>Chọn Tỉnh/Thành phố</option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}|{{ $province->name }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="district">Quận/Huyện<span class="text-danger"> (*)</span></label>
                                        <select class="form-control" name="district" id="district" required> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                {!! Form::label('Thành Phố') !!}
                                {!! Form::select('province', $provinces, null, ['class' => 'form-control province']) !!}
                            </div>
                            <div class="col-md-6 mb-3">
                                {!! Form::label('Huyện') !!}
                                {!! Form::select('district', ['--Chọn thành phố của bạn--'], null, ['class' => 'form-control district']) !!}
                            </div> --}}
                            <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="ward">Phường/Xã<span class="text-danger"> (*)</span></label>
                                    <select class="form-control" name="ward" id="ward" required>
                                    </select>
                                </div>
                            </div>
                            </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="nhanHang" checked>
                            <label class="form-check-label" for="defaultCheck1">
                                Địa chỉ nhận hàng và thanh toán giống nhau
                            </label>
                        </div>
                        <div id="hidden_option">
                            <div class="border-ship mb-3">
                            {{-- This is hidden: <input type="text" id="hidden_field" name="hidden"> --}}
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="name_2">Họ và tên người nhận<span class="text-danger"> (*)</span></label>
                                        <input type="text" name="name_2" id="name_2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label>Số điện thoại<span class="text-danger"> (*)</span></label>
                                        <input type="text" name="phone_2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Số nhà, Tên đường<span class="text-danger"> (*)</span></label>
                                <input type="text" name="address_2" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    {{-- <div class="form-group">
                                        <label for="province_id_2">Tỉnh/Thành phố<span class="text-danger"> (*)</span></label>
                                        <select class="form-control" name="province_id_2" id="province_id_2">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="">Tỉnh/Thành phố<span class="text-danger"> (*)</span></label>
                                        <select class="form-control" name="province_2" id="province_2">
                                            <option>Chọn Tỉnh/Thành phố</option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}|{{ $province->name }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="">Quận/Huyện<span class="text-danger"> (*)</span></label>
                                        <select class="form-control" name="district_2" id="district_2"> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label for="">Phường/Xã<span class="text-danger"> (*)</span></label>
                                    <select class="form-control" name="ward_2" id="ward_2">
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="gtgt">
                            <label class="form-check-label" for="defaultCheck1">
                                Yêu cầu xuất hóa đơn GTGT
                            </label>
                        </div>
                        <div id="hidden_gtgt">
                            <div class="border-ship">
                            {{-- This is hidden: <input type="text" id="hidden_field" name="hidden"> --}}
   
                           
                                    <div class="form-group">
                                        <label>Tên công ty/Hộ kinh doanh<span class="text-danger"> (*)</span></label>
                                        <input type="text" name="company" class="form-control">
                                    </div>
                     
                           
                                    <div class="form-group">
                                        <label>Mã số thuế<span class="text-danger"> (*)</span></label>
                                        <input type="text" name="tax_code" class="form-control">
                                    </div>
                   
                   
                            <div class="form-group">
                                <label>Địa chỉ xuất hóa đơn<span class="text-danger"> (*)</span></label>
                                <input type="text" name="address_vat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea rows="3" type="text" name="note_vat" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <div class="border-ship">
                        <h3 class="font-weight-bold text-monospace">Phương thức vận chuyển</h3>
                        <div class="form-check">
                            <input class="form-check-input one-checkbox" type="radio" name="transport" value="1" checked>
                            <label class="form-check-label one-checkbox" for="defaultCheck1">
                                Chuyển phát nhanh ( Phí vận chuyển bên mua thanh toán )
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input one-checkbox" type="radio" name="transport" value="2">
                            <label class="form-check-label one-checkbox" for="defaultCheck1">
                                Giao hàng tận nơi trong phạm vi TP.HCM
                            </label>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                        <div class="border-ship">
                        <h3 class="font-weight-bold text-monospace">Phương thức thanh toán</h3>
                        <hr>
                        <label><input type="radio" name="payment" value="payment_bank"> Chuyển khoản ngân hàng đối với khách hàng không ở TP.HCM</label>
                        <br>
                        <div class="payment_bank box alert alert-success">Số tài khoản: 263666688</div>
                        <label><input type="radio" name="payment" value="payment_cod" checked> Thu tiền khi nhận hàng đối với khách hàng ở TP.HCM</label>
                        <br>
                        {{-- <div class="payment_cod box">Ship code nha khách</div> --}}
                        <label><input type="radio" name="payment" value="payment_office"> Thanh toán tại cửa hàng đối với khách hàng tự đến lấy</label>
                        <br>
                        <div class="payment_office box alert alert-success">Địa chỉ: 280/39 Đường TX 25</div>
                    </div>
                    </div>
                    <div class="col-12">
                    <span class="text-danger"> (*)</span> <code>là những trường bắt buộc nhập</code>
                    </div>
                </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                    <div class="border-ship mb-3">
                    <h3 class="font-weight-bold text-monospace">Đơn hàng</h3>
                    <hr>
                                @foreach ($items as $item)
                                <div class="border-ship mb-3">
                                <div class="row">
                                <div class="col-3" style="align-self: center;">
                                <img src="/storage/uploads/{{ $item->attributes['img'] }}" width="100" alt="{{ $item->name }}" style="max-width: 100%">
                                </div>
                                
                                <div class="col-9">
                                <div class="info-products">
                                        <div><strong>{{ $item->name }}</strong></div>
                                        <div>Số lượng: {{ $item->quantity }}</div>
                                        <div>Giá: {{ product_price($item->quantity * $item->price) }}</div>
                                </div>
                                </div>
                                </div>
                                </div>
                                @endforeach
                        <div class="form-group">
                            <label class="font-weight-bold text-monospace">Ghi chú đơn hàng</label>
                            <textarea rows="3" type="text" name="note" class="form-control" ></textarea>
                        </div> 
                    {{-- <div class="col-12 mb-3" style="padding: 0px;">
                        <a href="{{ route('cart.checkout') }}" class="btn btn-success mr-2"><i class="fa fa-shopping-bag"></i> Thanh toán</a>
                        <a href="{{ route('cart.destroy') }}" class="btn btn-danger mr-2"><i class="fas fa-trash-alt"></i> Xóa toàn bộ</a>
                        <a href="" title="" class="btn btn-info"><i class="fas fa-cart-plus"></i> Tiếp tục mua sắm</a>
                    </div> --}}
                    {{-- <div class="col-12" style="padding: 0px;">
                        <form action="{{ route("cart.checkout.process") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="" class="form-control" name="phone">
                            </div>
                            <button class="btn btn-success">Xác nhận</button>
                        </form>
                    </div> --}}
                </div>
                <div class="alert alert-success col-12 font-weight-bold text-monospace"><h3 style="margin-bottom: 0px;">Tổng tiền: {{ product_price(Cart::getTotal()) }}</h3>
                        </div>
                        <button class="btn btn-success mb-3"><i class="fas fa-shopping-bag"></i> Xác nhận đặt hàng</button>
            </form>
            </div>
            </div>
        </div>
    </div>
@endif
@endsection

@push('style')
<style>
    .box{
        display: none;
    }
    /*.red{ background: #ff0000; }
    .green{ background: #228B22; }
    .blue{ background: #0000ff; }*/
</style>
@endpush

@push('script')
<script>
    $(function() {
      
      // Get the form fields and hidden div
      var checkbox = $("#nhanHang");
      var hidden = $("#hidden_option");
      // var populate = $("#populate");
      
      // Hide the fields.
      // Use JS to do this in case the user doesn't have JS 
      // enabled.
      hidden.hide();
      
      // Setup an event listener for when the state of the 
      // checkbox changes.
      checkbox.change(function() {
        // Check to see if the checkbox is checked.
        // If it is, show the fields and populate the input.
        // If not, hide the fields.
        if (checkbox.is(':checked')) {
          // Show the hidden fields.
          hidden.hide();
          // Populate the input.
          // populate.val("Dude, this input got populated!");
        } else {
          // Make sure that the hidden fields are indeed
          // hidden.
          hidden.show();
          
          // You may also want to clear the value of the 
          // hidden fields here. Just in case somebody 
          // shows the fields, enters data to them and then 
          // unticks the checkbox.
          //
          // This would do the job:
          //
          // $("#hidden_field").val("");
        }
      });
    });
</script>
<script>
    $(function() {
      
      // Get the form fields and hidden div
  
      var checkbox = $("#gtgt");
      var hidden = $("#hidden_gtgt");
      // var populate = $("#populate");
      
      // Hide the fields.
      // Use JS to do this in case the user doesn't have JS 
      // enabled.
      hidden.hide();
      
      // Setup an event listener for when the state of the 
      // checkbox changes.
      checkbox.change(function() {
        // Check to see if the checkbox is checked.
        // If it is, show the fields and populate the input.
        // If not, hide the fields.
        if (checkbox.is(':checked')) {
          // Show the hidden fields.
          hidden.show();
          // Populate the input.
          // populate.val("Dude, this input got populated!");
        } else {
          // Make sure that the hidden fields are indeed
          // hidden.
          hidden.hide();
          
          // You may also want to clear the value of the 
          // hidden fields here. Just in case somebody 
          // shows the fields, enters data to them and then 
          // unticks the checkbox.
          //
          // This would do the job:
          //
          // $("#hidden_field").val("");
        }
      });
    });
</script>
<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler 
    $("input:checkbox").on('click', function() {
      // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });
</script>
<script>
$('.one-checkbox').on('change', function() {
$('.one-checkbox').not(this).prop('checked', false);  
});
</script>
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>

{{-- <script type="text/javascript">
        
        $(document).on('input',"#province_id",function(e){
            e.preventDefault();
            $("#district_id").html('');
            $this = $(this);
            var id = $this.val();
            var url = "/province/"+id;
            $.get(url, function(result, status){
                var data = result.data;

                $.each(data, function(k,v){
                    var template = "<option value='"+v.id+"'>"+v.name+"</option>";
                    $("#district_id").append(template);
                })

            });
        });
</script> --}}
{{-- <script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
    $(document).on('input',"#province_id",function(e){
        e.preventDefault();
        $("#district_id").html('');
        $this = $(this);
        var id = $this.val();
        var url = "/province/"+id;
        $.get(url, function(result, status){
            var data = result.data;
            $.each(data, function(k,v){
                var template = "<option value='"+v.id+"'>"+v.name+"</option>";
                $("#district_id").append(template);
            })
        });
    });
</script> --}}
{{-- <script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
    $(function () {
        $('#province_id').on('change', function(e) { //viết sự kiện khi select được thay đổi thì gửi dữ liệu đi 1 lần để lấy dữ liệu cần.
            var id = $(this).val(); //lấy id từ của thành phố mà người dùng chọn 
            $.ajax({
                type: 'get', // phương thức gửi
                url: '/district/' + id, //tới route mà chúng ta đã định nghĩa ở trên.
                data: id, // gửi đi id của thành phố cần lấy.
            }).done(function(res) { // khi gửi và nhận thành công sẽ nhận được res
                var district = $('#district_id');
                for (var i in res) {
                    district.append('<option value="' +  res[i].id + '">' + res[i].name + '</option>');
                    //khi lấy được dữ liệu về thì ta đẩy nó vào ô select có chứa quận/huyện.
                    district.val(res[0].id); //select vào quận/huyện đầu tiên.
                }
            });
        });
    });
</script> --}}


<script type="text/javascript">
    $('#province').change(function(){
    var provinceID = $(this).val();    
    if(provinceID){
        $.ajax({
           type:"GET",
           url:"{{ url('get-district-list') }}?province_id="+provinceID,
           success:function(res){               
            if(res){
                $("#district").empty();
                $("#district").append('<option>Chọn Quận/Huyện</option>');
                $.each(res,function(key,name){
                    $("#district").append('<option value="'+key+'|'+name+'">'+name+'</option>');
                });
           
            }else{
               $("#district").empty();
            }
           }
        });
    }else{
        $("#district").empty();
        $("#ward").empty();
    }      
   });
    $('#district').on('change',function(){
    var districtID = $(this).val();    
    if(districtID){
        $.ajax({
           type:"GET",
           url:"{{ url('get-ward-list') }}?district_id="+districtID,
           success:function(res){               
            if(res){
                $("#ward").empty();
                $("#ward").append('<option>Chọn Phường/Xã</option>');
                $.each(res,function(key,name){
                    $("#ward").append('<option value="'+key+'|'+name+'">'+name+'</option>');
                });
           
            }else{
               $("#ward").empty();
            }
           }
        });
    }else{
        $("#ward").empty();
    }  
   });
</script>

<script type="text/javascript">
    $('#province_2').change(function(){
    var provinceID = $(this).val();    
    if(provinceID){
        $.ajax({
           type:"GET",
           url:"{{url('get-district-list')}}?province_id="+provinceID,
           success:function(res){               
            if(res){
                $("#district_2").empty();
                $("#district_2").append('<option>Chọn Quận/Huyện</option>');
                $.each(res,function(key,name){
                    $("#district_2").append('<option value="'+key+'|'+name+'">'+name+'</option>');
                });
           
            }else{
               $("#district_2").empty();
            }
           }
        });
    }else{
        $("#district_2").empty();
        $("#ward_2").empty();
    }      
   });
    $('#district_2').on('change',function(){
    var districtID = $(this).val();    
    if(districtID){
        $.ajax({
           type:"GET",
           url:"{{url('get-ward-list')}}?district_id="+districtID,
           success:function(res){               
            if(res){
                $("#ward_2").empty();
                $("#ward_2").append('<option>Chọn Phường/Xã</option>');
                $.each(res,function(key,name){
                    $("#ward_2").append('<option value="'+key+'|'+name+'">'+name+'</option>');
                });
           
            }else{
               $("#ward_2").empty();
            }
           }
        });
    }else{
        $("#ward_2").empty();
    }  
   });
</script>

{{-- validation --}}

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

{{-- <script>
function getSelectedText(elementId) {
    var elt = document.getElementById(elementId);

    if (elt.selectedIndex == '')
        return null;

    return elt.options[elt.selectedIndex].text;
}
var text = getSelectedText('district');
</script>
<script>
    $(document).ready(function(){
        $("#province_2").change(function(){
            $("#provincesave").val($(this).text());
        });
    });
</script> --}}
@endpush