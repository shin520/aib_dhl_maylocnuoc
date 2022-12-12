@extends('frontend.layout.master-layout')
@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <nav aria-label="breadcrumb" style="margin-top: 46px">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home.index') }}" title="{{ $setting->nameindex }}"><i class="ti-home"></i> Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ URL::current() }}" title="Giỏ hàng">Giỏ hàng</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow post" style="margin: 0 auto;">
        <div class="cart-content">
            <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            {{-- <form action="{{ route('cart.update') }}" method="POST"> --}}
                                @csrf
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên món</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach($order->items as $item)
                                    <tr class="row_cart" data-position_row="{{ $loop->index }}" data-id="{{ $item["id"] }}">
                                        <td>{{ $n }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>
                                          @php
                                            $img = $item['img'];
                                          @endphp
                                          <img src="{{ imageUrl('/storage/uploads/'.$img,'50','50','100','1') }}" width="50" class="img-fluid rounded mx-auto d-block" alt="{{ $item['name'] }}" style="border: none;padding: 0px;">
                                        </td>
                                        <td>
                                            <form action="{{ route('order.update',['id' => $item['id']]) }}" method="get" accept-charset="utf-8">
                                                <input type="number" name="quantity" min="1" max="100" value="{{ $item['quantity'] }}">
                                                {{-- <input type="submit" value="Update"> --}}
                                            </form>
                                        </td>
                                        <td>{{ number_format($item['sale_price']) }}₫</td>
                                        <td class="subtotal">{{ number_format($item['quantity']*$item['sale_price']) }}₫</td>
                                        <td><a href="{{ route('order.remove',['id'=>$item['id']]) }}"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Xóa món"></i></a></td>
                                    </tr>
                                    @php
                                        $n++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            {{-- </form> --}}
                        </table>
                    </div>
                    <div class="alert alert-success mb-3 col-12" class="total"><strong>Tổng tiền: <span id="total_price_cart">{{ number_format($order->total_price) }}</strong></span>₫
                    </div>
                    <div class="control-cart">
                        <a href="{{ route('checkout') }}" class="btn btn-success mr-2"><i class="fa fa-shopping-bag"></i> Đặt Món</a>
                        <a href="{{ route('order.clear') }}" class="btn btn-danger mr-2"><i class="fas fa-trash-alt"></i> Xóa toàn bộ</a>
                        <a href="{{ route('frontend.cat') }}" title="" class="btn btn-info"><i class="fas fa-cart-plus"></i> Tiếp tục chọn món</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('style')
@endpush

@push('script')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("input[name='quantity']").change(function () {
        var root = $(this).parents('.row_cart');
        var quantity = root.find("input[name='quantity']").val();
        var position_row = root.data('position_row');
        var id = root.data('id');
        $.ajax({
            url:"{{ route('order.update_cart') }}",
            type:"POST",
            dataType:'json',
            data:{quantity: quantity,position_row:position_row,id:id},
            success: function(result){
                console.log(result);
                root.find('.subtotal').html(result.subtotal);
                $("#total_price_cart").html(result.total);
            }
        })
    });

</script>

{{-- <script>
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
</script> --}}
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