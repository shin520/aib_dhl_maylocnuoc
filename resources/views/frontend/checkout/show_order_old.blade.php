<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Giỏ hàng</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <table class="table table-striped table-inverse table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
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
                        <td>
                            <form action="{{ route('order.update',['id' => $item['id']]) }}" method="get" accept-charset="utf-8">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}">
                                <input type="submit" value="Update">
                            </form>
                        </td>
                        <td>{{ number_format($item['quantity']*$item['sale_price']) }}₫</td>
                        <td><a href="{{ route('order.remove',['id'=>$item['id']]) }}" class="btn btn-sm btn-danger" title="">Xóa</a></td>
                    </tr>
                    @php
                        $n++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="alert alert-success"><strong>Tổng tiền: {{ number_format($order->total_price) }}₫</strong></div>
            <a href="{{ route('checkout') }}" class="btn btn-success" title="Đặt hàng">Đặt hàng</a>
            <a href="{{ route('frontend.home.index') }}" class="btn btn-info" title="Đặt hàng">Tiếp tục mua hàng</a>
            <a href="{{ route('order.clear') }}" class="btn btn-danger" title="Xóa Giỏ hàng">Xóa tất cả</a>
        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>