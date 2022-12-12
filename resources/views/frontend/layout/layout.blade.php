<div id="quickview" class="modal show" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="image margin-bottom-15">
              <a class="img-product clearfix" title="{{ $info->title }}" href="#">
                @php
                $img = $info->img;
                @endphp
                <img id="product-featured-image-quickview" class="center-block img-responsive product-featured-image-quickview" src="{{ imageUrl('/storage/uploads/'.$img,'398','398','100','1') }}" alt="{{ $info->name }}"  />
              </a>
            </div>
            <div id="thumbnail_quickview">
              <div class="thumblist"></div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="content">
              <h3 class="product-name"><a href="{{ route('frontend.home.index') }}/{{ $info->slug.'.html' }}">{{ $info->name }}</a></h3>
              <div class="status clearfix">
                Trạng thái: <span class="inventory">
                  Còn hàng
                </span>
              </div>
              @if($info->discount == 0 && $info->price > 0)
              <div class="price-box margin-bottom-20 clearfix">
                <div class="special-price f-left">
                  <span class="price product-price">{{ product_price_view($info->price) }}₫</span>
                </div>
              </div>
              @elseif($info->discount > 0)
              <div class="price-box margin-bottom-20 clearfix">
                <div class="special-price f-left">
                  <span class="price product-price">{{ product_price_view($info->selling_price) }}₫</span>
                </div>
                <div class="old-price">
                  <span class="price product-price-old">Giá gốc: <del class="price product-price-old">{{ product_price_view($info->price) }}₫</del> <span class="discount">(-{{ $info->discount }}%)</span></span>
                </div>
              </div>
              @else
              <div class="price-box margin-bottom-20 clearfix">
                <div class="special-price f-left">
                  <span class="price product-price">Liên hệ</span>
                </div>
              </div>
              @endif
              <div class="product-description rte">
                {!! $info->descriptions !!}
              </div>
              <div class="clearfix"></div>
              <form action="{{ route('order.now.quantity') }}" method="POST" class="form-group mb-2" >
                @csrf
                <input type="number" name="qty" min="1" max="10" value="1" class="form-control">
                <input type="hidden" name="product" value="{{ $info->id }}" class="form-control">
                <input type="hidden" name="productid_hidden" value="{{ $info->id }}">
                <br>
                <button type="submit" class="btn btn-lg btn-danger" name="buy_now" value="1" title="Mua ngay">Mua ngay</button>
                <button type="submit" class="btn btn-lg btn-info" name="buy_add_to_cart" value="0" title="Thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-close btn-default" data-dismiss="modal"><i class="fa fa-close"></i></button>
    </div>
  </div>
</div>