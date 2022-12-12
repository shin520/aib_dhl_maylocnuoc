@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Quản lý Bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Dịch vụ</a></li>
      {{-- <li><a href="{{ route('backend.servi.index') }}">Quản lý Dịch vụ</a></li> --}}
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
            <table id="servis" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.servi.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
                  <th>Tên bài viết</th>
                  <th>Hiển thị</th>
                  <th>Nổi bật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($servis as $k => $servi)
                <tr id="tr_{{ $servi->id }}">
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $servi->id }}">
                  </td>
                  <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $servi->id }}" value="@if(isset($servi->stt)){{ old('stt', $servi->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                  </td>
                  <td><a href="{{ route('backend.servi.edit', $servi->id) }}"><img src="/storage/uploads/{{ $servi->img }}" class="img-thumbnail" style="max-width: 50px; margin-bottom: 0px"></a></td>
                  <td><a href="{{ route('backend.servi.edit', $servi->id) }}">{{ $servi->name }}</a></td>
                  <td>
                    <input data-id="{{ $servi->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $servi->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <input data-id="{{ $servi->id }}" class="is_featured" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $servi->is_featured ? 'checked' : '' }} data-toggle="toggle" data-onstyle="warning" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa bài viết" href="{{ route('backend.servi.edit', $servi->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.servi.destroy', $servi->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá bài viết"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.servi.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
        alert("Vui lòng chọn ít nhất 1 bài viết để Xoá !");  
      }  else {  
        if(confirm("Xác nhận Xoá tất cả bài viết đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.servi.deletemultiple') }}",
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

<script>
function switchChange(){
  $('#servis').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var servi_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.servi.hideshow') }}',
      data: {'hide_show': hide_show, 'servi_id': servi_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();

  $(function(){
    $('#servis').on('change','input[class="is_new"]',function(){
      var is_new = $(this).prop('checked') == true ? 1 : 0; 
      var servi_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.servi.isnew') }}',
        data: {'is_new': is_new, 'servi_id': servi_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#servis').on('change','input[class="is_featured"]',function(){
      var is_featured = $(this).prop('checked') == true ? 1 : 0; 
      var servi_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.servi.isfeatured') }}',
        data: {'is_featured': is_featured, 'servi_id': servi_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

  $(function(){
    $('#servis').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var servi_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.servi.changestt') }}',
        data: {'stt': stt, 'servi_id': servi_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

})
</script>

@endpush