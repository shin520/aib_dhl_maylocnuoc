@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.productcategory.index') }}">Danh mục Sản phẩm</a></li>
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
            <table id="categories" class="table table-bordered table-striped" >
              <a href="{{ route('backend.productcategory.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  {{-- <th>Hình ảnh</th> --}}
                  <th>Tên danh mục</th>
                  <th>Danh mục cha</th>
                  <th>Ngày cập nhật</th>
                  <th>Hiển thị</th>
                  {{-- <th>Hiển thị menu</th> --}}
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($productcategories as $k => $productcategory)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox" data-id="{{$productcategory->id}}">
                    </label>
                  </td>
                  <td>{{ $productcategory->stt }}</td>
                  {{-- <td>
                    <a href="{{ route('backend.productcategory.edit', $productcategory->id) }}"><img src="/storage/uploads/{{ $productcategory->img }}" class="img-thumbnail" style="max-width: 50px">
                    </a>
                  </td> --}}
                  <td><strong><a href="{{ route('backend.productcategory.edit', $productcategory->id) }}">{{ $productcategory->name }}</a></strong></td>
                  <td>
                    @if($productcategory->parent_id == 0)
                      {{ "None" }}
                    @else
                      @php
                        $parent = Productcategory::where('id',$productcategory->parent_id)->first();
                        echo $parent->name;
                      @endphp
                    @endif
                  </td>
                  <td>{{ date("d/m/Y", strtotime($productcategory->updated_at)) }}</td>
                  <td>
                    @if($productcategory->hide_show == 1)
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
                  </td>
                  {{-- <td>
                    @if($productcategory->show_nav == 1)
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
                    <div class="@php
                    if ($productcategory->status == 'Published') {
                      echo 'badge bg-green';
                      }else {
                        echo "badge bg-red";
                      }
                      @endphp">
                      @php
                      if ($productcategory->status == 'Published') {
                        echo 'Xuất bản';
                      }else {
                        echo "Chờ duyệt";
                      }
                      @endphp
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="{{ route('backend.productcategory.edit', $productcategory->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.productcategory.destroy', $productcategory->id) }}" onclick="return confirm('Xác nhận Xóa ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá danh mục"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.productcategory.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push("script")
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
        alert("Vui lòng chọn ít nhất 1 danh mục để XOÁ !");  
      }  else {  
        if(confirm("Bạn có chắc chắn, XOÁ TẤT CẢ danh mục đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.productcategory.deletemultiple') }}",
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
@php
// function TableCategories($categories, $parent_id = 0, $char = '')
// {
//     foreach ($categories as $key => $item)
//     {
//         // Nếu là chuyên mục con thì hiển thị
//         if ($item->parent_id == $parent_id)
//         {
//             echo '<tr>';
//                 echo '<td>'.$item->stt.'</td>';
//                 echo '<td>'.$item->img.'</td>';
//                 echo '<td>'.$char . $item->name.'</td>';
//                 echo '<td>'.$item->updated_at.'</td>';
//                 echo '<td>'.$item->hide_show.'</td>';
//                 echo '<td>'.$item->status.'</td>';
//                 echo '<td>'..'</td>';
//                 echo '<td>'..'</td>';
//             echo '</tr>';
             
//             // Xóa chuyên mục đã lặp
//             unset($categories[$key]);
             
//             // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
//             TableCategories($categories, $item->id, $char.'---');
//         }
//     }
// }
@endphp