@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Newsletters
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Newsletters</a></li>
      <li><a href="{{ route('newsletter.index') }}">Quản lý Newsletters</a></li>
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
            <table id="newsletters" class="table table-bordered table-striped" >
              <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Email</th>
                  <th>Ngày đăng ký</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($newsletters as $k => $newsletter)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox" data-id="{{ $newsletter->id }}">
                    </label>
                  </td>
                  <td>{{ $newsletter->stt }}</td>
                  <td>{{ $newsletter->email }}</td>
                  <td>{{ date("d/m/Y", strtotime($newsletter->created_at)) }}</td>
                  <td>
                    <div class="@php
                    if ($newsletter->read == 1) {
                      echo 'badge bg-green';
                      }else {
                        echo "badge bg-red";
                      }
                      @endphp">
                      @php
                      if ($newsletter->read == 1) {
                        echo 'Xác nhận';
                      }else {
                        echo "Mới";
                      }
                      @endphp
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa thông tin" href="{{ route('newsletter.edit', $newsletter->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('newsletter.destroy', $newsletter->id) }}" onclick="return confirm('Xác nhận Xóa ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá thông tin"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
        alert("Vui lòng chọn ít nhất 1 Email để Xóa !");  
      }  else {  
        if(confirm("Bạn có chắc chắn, Xóa Tất Cả Email đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('newsletter.delete.multiple') }}",
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
  $(function () {
    $('#newsletters').DataTable({
      'order'       : [0],
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,5] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
  })
</script>
@endpush