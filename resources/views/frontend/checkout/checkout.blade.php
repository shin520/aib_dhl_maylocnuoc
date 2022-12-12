@extends('frontend.layout.master-layout')
@section('content')
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <li class="home">
                            <a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang
                                    chủ</span></a>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        <li><strong itemprop="title"><a href="{{ route('order.view') }}">Giỏ hàng</a></strong>
                            <span><i class="fa fa-angle-right"></i></span>
                        </li>
                        <li><strong itemprop="title"><a href="{{ URL::current() }}">Xác nhận đơn
                                    hàng</a></strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-4 main-content">
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
                @if (count($order->items) > 0)
                    <article class="card shadow post">
                        <div class="card-content">
                            <div>
                                <div class="main-title text-center mt-3">
                                    <h1 class="title" style="font-size: 26px;">Xác nhận đơn hàng</h1>
                                </div>
                                <h2 style="position:absolute; top:-1000px;">Xác nhận đơn hàng</h2>
                                <h3 style="position:absolute; top:-1000px;">Xác nhận đơn hàng</h3>
                                <div class="container">
                                    <hr>
                                    @if ($errors->any())
                                        <div id="error_order" class="alert alert-danger" style="display: none">
                                            <ul style="padding-left: 0px;">
                                                @foreach ($errors->all() as $error)
                                                    <li style="line-height: 32px;">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" action="" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Họ và Tên</label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" placeholder="Nhập Họ và Tên">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" name="email" value="{{ old('email') }}"
                                                        class="form-control" placeholder="Nhập Email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                                        class="form-control" placeholder="Nhập số điện thoại">
                                                </div>
                                                <div class="form-group">
                                                    <label>Địa chỉ</label>
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        class="form-control" placeholder="Nhập địa chỉ">
                                                </div>
                                                <div class="form-group">
                                                    <label>Ghi chú</label>
                                                    <textarea class="form-control" name="order_note" placeholder="Nhập ghi chú (tùy chọn)" rows="3">{{ old('order_note') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Thông tin đơn hàng</label>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr style="background-color: rgba(0,0,0,0.075);">
                                                                <th class="text-center">Tên sản phẩm</th>
                                                                <th class="text-center">Hình ảnh</th>
                                                                <th class="text-center">Giá</th>
                                                                <th class="text-center">Số lượng</th>
                                                                <th class="text-center">Thành tiền</th>
                                                                <th class="text-center"><i class="fa fa-gear"></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->items as $item)
                                                                <tr class="text-center">
                                                                    <td class="text-center">{{ $item['name'] }}</td>
                                                                    @php
                                                                        $img = $item['img'];
                                                                    @endphp
                                                                    <td class="text-center">
                                                                        {{-- <img src="{{ imageUrl('/storage/uploads/'.$img,'50','50','100','1') }}" width="50" class="img-fluid rounded mx-auto d-block" alt="{{ $item['name'] }}" style="border: none;padding: 0px;"> --}}
                                                                        <img src="{{ asset('/storage/uploads/' . $img) }}"
                                                                            width="50"
                                                                            class="img-fluid rounded mx-auto d-block"
                                                                            alt="{{ $item['name'] }}"
                                                                            style="border: none;padding: 0px;">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ number_format($item['sale_price']) }}₫</td>
                                                                    <td class="text-center">{{ $item['quantity'] }}</td>
                                                                    <td class="text-center">
                                                                        {{ number_format($item['quantity'] * $item['sale_price']) }}₫
                                                                    </td>
                                                                    <td class="text-center"><a
                                                                            href="{{ route('order.view') }}"><i
                                                                                class="fa fa-edit" data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Sửa số lượng"></i></a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="alert alert-success">
                                                    <strong>Tổng tiền: {{ number_format($order->total_price) }}₫</strong>
                                                </div>
                                                <button type="submit" class="btn btn-success mb-3"
                                                    title="Xác nhận đặt hàng">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @else
                    <div class="container white collections-container margin-bottom-20">
                        <div class="white-background">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="shopping-cart">
                                        <div class="visible-md visible-lg">
                                            <div class="shopping-cart-table">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="lbl-shopping-cart lbl-shopping-cart-gio-hang">Giỏ hàng
                                                            <span>(<span
                                                                    class="count_item_pr">{{ $order->total_quantity }}</span>
                                                                Sản phẩm)</span>
                                                        </h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <div class="cart-empty">
                                                            <img src="/images/empty-cart.png"
                                                                class="img-responsive center-block" alt="Giỏ hàng trống">
                                                            <div class="btn-cart-empty">
                                                                <a class="btn btn-default"
                                                                    href="{{ route('frontend.cat') }}"
                                                                    title="Tiếp tục mua sắm">Tiếp tục mua sắm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-sm-none d-xs-none">
                                            <div class="cart-empty">
                                                <img src="/images/empty-cart.png" class="img-responsive center-block"
                                                    alt="Giỏ hàng trống">
                                                <div class="btn-cart-empty">
                                                    <a class="btn btn-default" href="{{ route('frontend.cat') }}"
                                                        title="Tiếp tục mua sắm">Tiếp tục mua sắm</a>
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
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
                <div class="payment_method">
                    <div class="accordion" id="accordionExample">
                        @php
                            $data = Tutorial::orderBy('stt','asc')->orderBy('id','desc')->get();
                        @endphp
                        @foreach ($data as $item)
                            <div class="card">

                                <div class="card-header" id="heading_{{$item->id}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left {{ $loop->first ? '' : 'collapsed'}}" type="button"
                                            data-toggle="collapse" data-target="#collapse_{{$item->id}}" aria-expanded="{{ $loop->first ? 'true' : 'false'}}"
                                            aria-controls="collapse_{{$item->id}}">
                                            {{ $item->name }}
                                        </button>   
                                    </h2>
                                </div>
                                <div id="collapse_{{$item->id}}" class="collapse" aria-labelledby="heading_{{$item->id}}"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $item->content !!}
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
@endpush
