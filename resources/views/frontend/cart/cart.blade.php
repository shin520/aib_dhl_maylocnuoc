@extends('frontend.layout.master-layout')

@php
    $items = Cart::getContent();
    $count_item = $items->count();
    $count = Cart::getTotalQuantity();
    // dd($count);
@endphp

@section('content')
<nav aria-label="breadcrumb" style="margin-top: 10px">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}"><i class="ti-home"></i> Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="Giỏ hàng">Giỏ hàng</a></li>
    </ol>
</nav>
<div class="container mb-5">
    @if($count_item == '')
    <div class="container">
        <div class="row">
        <div class="alert alert-danger col-12">
            Giỏ hàng không có sản phẩm. Vui lòng chọn sản phẩm !
        </div>
        </div>
    </div>
    @else
    <div class="card shadow post" style="margin: 0 auto;">
        <div class="cart-content">
            <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($items as $item)
                                    <tr>
                                        <td><img src="/storage/uploads/{{ $item->attributes['img'] }}" width="50" alt="{{ $item->name }}"></td>
                                        <td>{{ $item->name }}</td>
                                        <td><input type="number" name="qty[{{ $item->id }}]" value="{{ $item->quantity }}" style="text-align: center;"> <button class="btn-update-cart"><i class="fa fa-sync-alt" data-toggle="tooltip" data-placement="top" title="Cập nhật Thành tiền"></i></button>
                                        </td>
                                        <td>{{ product_price($item->price) }}</td>
                                        <td>{{ product_price($item->quantity * $item->price) }}</td>
                                        <td><a href="{{ route('cart.remove', $item->id ) }}"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Xóa sản phẩm"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </form>
                        </table>
                    </div>
                    <div class="alert alert-success mb-3 col-12">Tổng tiền: {{ product_price(Cart::getTotal()) }}
                    </div>
                    <div class="control-cart">
                        <a href="{{ route('cart.checkout') }}" class="btn btn-success mr-2"><i class="fa fa-shopping-bag"></i> Thanh toán</a>
                        <a href="{{ route('cart.destroy') }}" class="btn btn-danger mr-2"><i class="fas fa-trash-alt"></i> Xóa toàn bộ</a>
                        <a href="" title="" class="btn btn-info"><i class="fas fa-cart-plus"></i> Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
@endsection

@push('style')
@endpush

@push('script')
<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var n = 1;
         
          $('.plus').on('click', function(){
             var id = $(this).attr('data-id');
             var val = $("#input_"+id).val();
             $("#input_"+id).val(++val);
             update_price(id, 'plus')
          });

          $('.min').on('click', function(){
             var id = $(this).attr('data-id');
             var val = $("#input_"+id).val();

             if (val >= 2){
                $("#input_"+id).val(--val);
                update_price(id, 'min')
             }
          });
          function update_price(id, type) {

             var price = $("#price_"+id).attr('data-price');
             var qty = $("#input_"+id).val();
             var total = $("#total").text().replace('.','').replace('₫','');
             var sub = parseInt(price * qty);
             $("#subtotal_"+id).attr("data-price", sub);
             $("#subtotal_"+id).text(number_format(sub, 0,'.')+'₫');

             var total = 0;

             $(".sub").map(function() {
                // console.log( $(this).attr('data-price') + '<br>')
                 total += parseInt( $(this).attr('data-price') );
             });

             console.log(total);

             $("#total").text(number_format(total, 0,'.')+'₫');

             $.ajax({
                url : "http://vnlar.local/cart/cart/update/"+id,
                type: 'POST',
                data: {
                    qty: qty
                },
                success: function(res){
                    console.log(res)
                }
             });
          }
          function number_format( number, decimals, dec_point, thousands_sep )
              {
                  var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
                  var d = dec_point == undefined ? "," : dec_point;
                  var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
                  var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
              }    
          $('.min').on('click', function(){
              if (n >= 1) {
                $("#qty").val(--n);
              }
          });
    </script>
    <script>
    var n = 1;
      $('.plus').on('click', function(){
         var id = $(this).attr('data-id');
         var val = $("#input_"+id).val();
         $("#input_"+id).val(++val);
         update_price(id, 'plus')
      });

      $('.min').on('click', function(){
         var id = $(this).attr('data-id');
         var val = $("#input_"+id).val();

         if (val >= 2){
            $("#input_"+id).val(--val);
            update_price(id, 'min')
         }
      });

      function update_price(id, type) {

         var price = $("#price_"+id).attr('data-price');
         var qty = $("#input_"+id).val();
         var total = $("#total").text().replace('.','').replace('₫','');
         var sub = parseInt(price * qty);
         $("#subtotal_"+id).attr("data-price", sub);
         $("#subtotal_"+id).text(number_format(sub, 0,'.')+'₫');
         var total = 0;
         $(".sub").map(function() {
            // console.log( $(this).attr('data-price') + '<br>')
             total += parseInt( $(this).attr('data-price') );
         });
         // console.log(total);
         $("#total").text(number_format(total, 0,'.')+'₫');
         $.ajax({
            url : "https://hnelectric.vn/cart/update/"+id,
            type: 'POST',
            data: {
                qty: qty
            },
            headers: {
                'X-CSRF-TOKEN': "GvpDbmSyemyDR9H4QCgoP1u6yCQtLc8zzIzUgnFR"
            },
            success: function(res){
                $("#cart_content").load("https://hnelectric.vn/cart/cart-content");
            }
         });
      }

      $(document).on('click', '.remove', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $("#row_"+id).hide();
        $.get("https://hnelectric.vn/cart/remove/"+id, function(){
            $("#cart_content").load("https://hnelectric.vn/cart/cart-content");
        });
      });
      function number_format( number, decimals, dec_point, thousands_sep )
          {
              var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
              var d = dec_point == undefined ? "," : dec_point;
              var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
              var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
              return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
          }
</script>
@endpush



{{-- @extends('frontend.layout.master-layout')

@php
    $items = Cart::getContent();

@endphp

@section('content')

    <div class="container">
        đây là trang chứa các sp đã thêm vào giỏ hàng

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->quantity) }}</td>
                        <td>{{ price($item->price, '$ ', 1, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        Tổng tiền: {{ Cart::getTotal() }}
    </div>

@endsection

@push('style')
@endpush

@push('script')
@endpush --}}