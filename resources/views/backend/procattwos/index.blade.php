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
      <li><a href="{{ route('backend.procattwo.index') }}">Danh mục Cấp 2</a></li>
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
            <table id="procattwos" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.procattwo.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>
                    <div class="form-group">
                      <select class="form-control select2" style="max-width: 100%;">
                        <option selected="selected">Chọn danh mục cấp 1</option>
                        @foreach($procatones as $procatone)
                        <option>{{ $procatone->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </th>
                  <th>Tên danh mục</th>
                  <th>Ngày cập nhật</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($procattwos as $procattwo)
                <tr>
                <td>
                  <label>
                    <input type="checkbox" class="checkbox" data-id="{{ $procattwo->id }}">
                  </label>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $procattwo->id }}" value="@if(isset($procattwo->stt)){{ old('stt', $procattwo->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                </td>
                <td>
                  {{ $procattwo->procatone->name ?? '' }}
                </td>
                <td>{{ $procattwo->name ?? '' }}</td>
                <td>{{ date("d/m/Y", strtotime($procattwo->updated_at)) }}</td>
                <td>
                  <input data-id="{{ $procattwo->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $procattwo->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                </td>
                <td>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="{{ route('backend.procattwo.edit', $procattwo->id ) }}"><i class="fa fa-edit"></i></a>
                  <form method="POST" action="{{ route('backend.procattwo.destroy', $procattwo->id) }}" onclick="return confirm('Xác nhận Xóa ?')" style="display: inline;">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá danh mục"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                {{-- @php
                  recursveTable ($productcategories);
                @endphp --}}
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.procattwo.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
  $('#procattwos').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var procattwo_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.procattwo.hideshow') }}',
      data: {'hide_show': hide_show, 'procattwo_id': procattwo_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();

  $(function(){
    $('#procattwos').on('change','input[class="is_new"]',function(){
      var is_new = $(this).prop('checked') == true ? 1 : 0; 
      var procattwo_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procattwo.isnew') }}',
        data: {'is_new': is_new, 'procattwo_id': procattwo_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#procattwos').on('change','input[class="is_featured"]',function(){
      var is_featured = $(this).prop('checked') == true ? 1 : 0; 
      var procattwo_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procattwo.isfeatured') }}',
        data: {'is_featured': is_featured, 'procattwo_id': procattwo_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#procattwos').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var procattwo_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procattwo.changestt') }}',
        data: {'stt': stt, 'procattwo_id': procattwo_id},
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
        alert("Vui lòng chọn ít nhất 1 danh mục để XOÁ !");  
      }  else {  
        if(confirm("Bạn có chắc chắn, XOÁ TẤT CẢ danh mục đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.procattwo.deletemultiple') }}",
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