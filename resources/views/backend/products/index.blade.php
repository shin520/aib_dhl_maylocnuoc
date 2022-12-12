@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Sản phẩm
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.product.index') }}">Quản lý Sản phẩm</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          @if (Session::has('success'))
          <div class="alert-custom">
            <div class="alert alert-success">{{ Session::get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @endif
          <div class="box-body">
            <table id="products" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.product.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Hình ảnh</th>
                  <th>
                    <div class="form-group">
                      <select class="form-control select2 choose procatone" name="procatone" id="procatone" style="width: 180px;">
                        <option value="">Chọn cấp 1</option>
                        @foreach($procatones as $key => $procatone)
                        <option value="{{ $procatone->name }}" data-id="{{ $procatone->id }}">{{ $procatone->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </th>
                  <th>
                    <div class="form-group">
                      <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo" style="width: 180px;">
                        <option value="">Chọn cấp 2</option>
                      </select>
                    </div>
                  </th>
                  {{-- <th>
                    <div class="form-group">
                      <select class="form-control select2 procatthree" name="procatthree" id="procatthree" style="max-width: 100%;">
                        <option value="">Chọn cấp 3</option>
                      </select>
                    </div>
                  </th> --}}
                  <th width="130px">Tên sản phẩm</th>
                  <th>Hiển thị</th>
                  <th>Mới</th>
                  <th>Nổi bật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $k => $product)
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $product->id }}">
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" data-id="{{ $product->id }}" value="@if(isset($product->stt)){{ old('stt', $product->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                    </div>
                  </td> 
                  <td>
                    <a href="{{ route('backend.product.edit', $product->id) }}"><img src="/storage/uploads/{{ $product->img }}" class="img-thumbnail" style="max-width: 45px; margin-bottom: 0px">
                    </a>
                  </td>
                  {{-- <td >
                    @foreach ($product->productcategories()->get() as $productcategory)
                    <li class="category-name">{!! $productcategory->name !!}</li>
                    @endforeach
                  </td> --}}
                  <td>
                    @php
                      $cateone = DB::table('procatones')->where('id', $product->procatone_id)->first();
                    @endphp
                    {{ $cateone->name ?? '' }}
                  </td>

                  <td>
                    @php
                      $catetwo = DB::table('procattwos')->where('id', $product->procattwo_id)->first();
                    @endphp
                    {{ $catetwo->name ?? '' }}
                  </td>

                  {{-- <td>
                    @php
                      $catethree = DB::table('procatthrees')->where('id', $product->procatthree_id)->first();
                    @endphp
                    {{ $catethree->name ?? '' }}
                  </td> --}}

                  <td><a href="{{ route('backend.product.edit', $product->id) }}">{{ $product->name }}</a></td>
                  {{-- <td>
                    @if($product->hide_show == 1)
                    <div class="form-group">
                      <div class="form-group has-success">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i></label>
                      </div>
                    </div>
                    @else
                    <div class="form-group has-error">
                      <label class="control-label" for="inputError"><i class="fa fa-times"></i></label>
                    </div>
                    @endif
                  </td> --}}
                  <td>
                    <input data-id="{{ $product->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $product->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <input data-id="{{ $product->id }}" class="is_new" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $product->is_new ? 'checked' : '' }} data-toggle="toggle" data-onstyle="warning" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <input data-id="{{ $product->id }}" class="is_featured" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $product->is_featured ? 'checked' : '' }} data-toggle="toggle" data-onstyle="info" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm" href="{{ route('backend.product.edit', $product->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.product.destroy', $product->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá sản phẩm"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.product.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
  $('#products').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var product_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.product.hideshow') }}',
      data: {'hide_show': hide_show, 'product_id': product_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();
  $('.choose').on('change',function(){
    var action  = $(this).attr('id');
    var code_id = $(this).find(':selected').data('id')
    var _token  = $('input[name="_token"]').val();
    var result  = '';
    if (action == 'procatone'){
      result = 'procattwo';
    }else{
      result = 'procatthree';
    }
    $.ajax({
      url : '{{ route('backend.product.select') }}',
      method : 'POST',
      data: {action:action,code_id:code_id,_token:_token},
      success:function(data){
        $('#'+result).html(data);
      }
    });
  });

  $(function(){
    $('#products').on('change','input[class="is_new"]',function(){
      var is_new = $(this).prop('checked') == true ? 1 : 0; 
      var product_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.isnew') }}',
        data: {'is_new': is_new, 'product_id': product_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#products').on('change','input[class="is_featured"]',function(){
      var is_featured = $(this).prop('checked') == true ? 1 : 0; 
      var product_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.isfeatured') }}',
        data: {'is_featured': is_featured, 'product_id': product_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#products').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var product_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.changestt') }}',
        data: {'stt': stt, 'product_id': product_id},
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
        alert("Vui lòng chọn ít nhất 1 sản phẩm để Xoá !");  
      }  else {  
        if(confirm("Xác nhận Xoá tất cả sản phẩm đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.product.deletemultiple') }}",
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