<div class="container mb-5">
  <div class="mx-auto font-weight-bold">
    <div class="main-title">
      <h2 class="text-center mb-4">SẢN PHẨM</h2>
    </div>
  </div>
  <div class="card-deck">
    <div class="row">
    @foreach($products as $product)
    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-4">
    <div class="card">
      <a href="{{ route('frontend.home.index') }}/san-pham/{{ $product->slug.'.html' }}"><img class="card-img-top" src="/storage/uploads/{{ $product->img }}" alt="Card image cap"></a>
      <div class="card-body">
        <h5 class="card-title"><a href="{{ route('frontend.home.index') }}/san-pham/{{ $product->slug.'.html' }}" title="">{{ $product->name }}</a></h5>
        <p class="card-text">{{ $product->descriptions }}</p>
        <p class="card-price">
          @if($product->discount == NULL)
            {{ product_price_view($product->price) }}₫
          @else
            {{ product_price_view($product->selling_price) }}₫
          @endif
        </p>
        <a href="{{ route('cart.quick_buy', $product->id) }}" class="btn btn-danger mb-3" title="cart">Mua ngay</a>
        <a href="{{ route('order.add',$product->id) }}" class="btn btn-success mb-3" title="cart">Mua Custom</a>
        {{-- <a href="{{ route('order.add',['id'=>$product->id]) }}" class="btn btn-success mb-3" title="cart">Mua Custom</a> --}}
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
    </div>
    @endforeach
    <nav style="margin: 0 auto;">
      <ul class="pagination justify-content-center mb-4">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
      </ul>
    </nav>
    </div>
  </div>
</div>