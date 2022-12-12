@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Videos
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hosting</a></li>
      <li><a href="{{ route('video.index') }}">Quản lý Videos</a></li>
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
            <table id="videos" class="table table-bordered table-striped">
              <a href="{{ route('video.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th >
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Hình ảnh</th>
                  <th>Tên Videos</th>
                  <th>Hiển thị</th>
                  <th>Nổi bật</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($videos as $k => $video)
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $video->id }}">
                  </td>
                  <td>{{ $video->stt }}</td>
                  <td>
                    <a href="{{ route('video.edit', $video->id) }}"><img src="https://i.ytimg.com/vi/{{ $video->url_code }}/maxresdefault.jpg" class="img-thumbnail" style="max-width: 50px">
                    </a>
                  </td>
                  <td>{{ $video->name }}</td>
                  <td>
                    @if($video->hide_show == 1)
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
                  <td>
                    @if($video->is_featured == 1)
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
                  <td>
                    <div class="@php
                    if ($video->status == 'Published') {
                      echo 'badge bg-green';
                      }else {
                        echo "badge bg-red";
                      }
                      @endphp">
                      @php
                      if ($video->status == 'Published') {
                        echo 'Xuất bản';
                      }else {
                        echo "Chờ duyệt";
                      }
                      @endphp
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa Video" href="{{ route('video.edit', $video->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('video.destroy', $video->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá Video"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('video.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
        alert("Vui lòng chọn ít nhất 1 Video để Xoá !");  
      }  else {  
          if(confirm("Xác nhận Xoá tất cả Video đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('video.delete.multiple') }}",
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