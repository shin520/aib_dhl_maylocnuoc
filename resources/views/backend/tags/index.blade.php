@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Tags
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Bài viết</a></li>
      <li><a href="{{ route('backend.tag.index') }}">Quản lý Tags</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          @if (Session::has('success'))
          <div class="alert-custom">
            <div class="alert alert-success">{{ Session::get('success') }}</div>
          </div>
          @endif
          <div class="box-body">
            <table id="tags" class="table table-bordered table-striped">
              <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Tên Tags</th>
                  <th>Ngày tạo</th>
                  <th>Ngày cập nhật</th>
                  <th>Hiển thị</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tags as $k => $tag)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox" data-id="{{$tag->id}}">
                    </label>
                  </td>
                  <td>{!! $k + 1 !!}</td>
                  <td><a href="{{ route('backend.tag.view', $tag->id) }}">{{ $tag->name }} <span class="badge bg-light-blue">{{ $tag->articles()->count() }}</span></a></td>
                  <td>
                    <li>{{ date("d/m/Y", strtotime($tag->created_at)) }}</li>
                  </td>
                  <td>
                    <li>{{ date("d/m/Y", strtotime($tag->updated_at)) }}</li>
                  </td>
                  <td>
                    @if($tag->hide_show == 1)
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
                    if ($tag->status == 'Published') {
                      echo 'badge bg-green';
                      }else {
                        echo "badge bg-red";
                      }
                      @endphp">
                      @php
                      if ($tag->status == 'Published') {
                        echo 'Xuất bản';
                      }else {
                        echo "Chờ duyệt";
                      }
                      @endphp
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa Tag" href="{{ route('backend.tag.edit', $tag->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.tag.destroy', $tag->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá Tag"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
        alert("Vui lòng chọn ít nhất 1 Tag để Xoá !");  
      }  else {  
        if(confirm("Xác nhận Xoá tất cả Tags đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('backend.tag.deletemultiple') }}",
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