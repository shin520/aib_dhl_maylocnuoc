@extends('frontend.layout.master-layout')
@section('content')
<section class="bread-crumb margin-bottom-10">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
          <li class="home">
            <a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
            <span><i class="fa fa-angle-right"></i></span>
          </li>
          <li><strong itemprop="title"><a href="{{ route('order.view') }}">Giỏ hàng</a></strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="container mb-5">
  @if(count($order->items) > 0)
  <div class="card shadow post" style="margin: 0 auto; margin-bottom: 40px">
    <div class="cart-content">
      <div class="container">
        <div class="row">
          <div class="table-responsive">
            <table class="table">
              @csrf
              <thead>
                <tr style="background-color: rgba(0,0,0,0.075);">
                  <th class="text-center">Sản phẩm</th>
                  <th class="text-center">Hình ảnh</th>
                  <th class="text-center">Số lượng</th>
                  <th class="text-center">Đơn giá</th>
                  <th class="text-center">Thành tiền</th>
                  <th class="text-center">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order->items as $item)
                <tr class="row_cart" data-position_row="{{ $loop->index }}" data-id="{{ $item["id"] }}">
                  <td class="text-center">{{ $item['name'] }}</td>
                  <td class="text-center">
                    @php
                    $img = $item['img'];
                    @endphp
                    {{-- <img src="{{ imageUrl('/storage/uploads/'.$img,'50','50','100','1') }}" width="50" class="img-fluid rounded mx-auto d-block" alt="{{ $item['name'] }}" style="border: none;padding: 0px;"> --}}
                    <img src="{{ asset('/storage/uploads/'.$img) }}" width="50" class="img-fluid rounded mx-auto d-block" alt="{{ $item['name'] }}" style="border: none;padding: 0px;">
                  </td>
                  <td>
                    <form action="{{ route('order.update',['id' => $item['id']]) }}" method="get" accept-charset="utf-8" style="margin-bottom: 0">
                      <input type="number" name="quantity" min="1" max="100" value="{{ $item['quantity'] }}" style="padding: 5px 0px 5px 10px;">
                    </form>
                  </td>
                  <td class="text-center">{{ number_format($item['sale_price']) }}₫</td>
                  <td class="subtotal text-center">{{ number_format($item['quantity']*$item['sale_price']) }}₫</td>
                  <td class="text-center"><a href="{{ route('order.remove',['id'=>$item['id']]) }}"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Xóa sản phẩm"></i></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="alert alert-success mb-3 col-12" class="total"><strong>Tổng tiền: <span id="total_price_cart">{{ number_format($order->total_price) }}₫</strong></span>
        </div>
        <div class="control-cart" id="right-affix">
          <a href="{{ route('checkout') }}" title="Đặt hàng" class="btn btn-success btn-checkout mr-2"><i class="fa fa-shopping-bag"></i> Đặt hàng</a>
          <a href="{{ route('order.clear') }}" title="Xóa giỏ hàng" class="btn btn-checkout-del mr-2"><i class="fa fa-trash"></i> Xóa toàn bộ</a>
          <a href="{{ route('frontend.cat') }}" title="Tiếp tục mua hàng" class="btn btn-checkouts"><i class="fa fa-cart-plus"></i> Tiếp tục mua hàng</a>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="container white collections-container margin-bottom-20">
    <div class="white-background">
      <div class="row">
        <div class="col-md-12">
          <div class="shopping-cart">
            <div class="visible-md visible-lg">
              <div class="shopping-cart-table">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h1 class="lbl-shopping-cart lbl-shopping-cart-gio-hang">Giỏ hàng <span>(<span class="count_item_pr">{{ $order->total_quantity }}</span> Sản phẩm)</span></h1>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="cart-empty">
                      <img src="/images/empty-cart.png" class="img-responsive center-block" alt="Giỏ hàng trống">
                      <div class="btn-cart-empty">
                        <a class="btn btn-default" href="{{ route('frontend.cat') }}" title="Tiếp tục mua sắm">Tiếp tục mua sắm</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-sm-none d-xs-none">
              <div class="cart-empty">
                <img src="/images/empty-cart.png" class="img-responsive center-block" alt="Giỏ hàng trống">
                <div class="btn-cart-empty">
                  <a class="btn btn-default" href="{{ route('frontend.cat') }}" title="Tiếp tục mua sắm">Tiếp tục mua hàng</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
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
              // console.log(result);
              root.find('.subtotal').html(result.subtotal);
              $("#total_price_cart").html(result.total);
          }
      })
  });
</script>
@endpush