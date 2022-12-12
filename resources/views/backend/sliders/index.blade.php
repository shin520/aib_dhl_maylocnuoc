@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
@php
  $segment2 = Request::segment(2);
@endphp
@if($segment2 == "slider")
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.slider.index') }}">Quản lý hình ảnh</a></li>
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
            <table id="sliders" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.slider.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
                  <th>Tiêu đề</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sliders as $k => $slider)
                @if($slider->type == 'slider')
                <tr id="tr_{{ $slider->id }}">
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $slider->id }}">
                  </td>
                  <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $slider->id }}" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                  </td>
                  <td><a href="{{ route('backend.slider.edit', $slider->id) }}"><img src="/storage/uploads/{{ $slider->img }}" class="img-thumbnail" style="margin-bottom: 0px; max-width: 50px"></a></td>
                  <td><a href="{{ route('backend.slider.edit', $slider->id) }}">{{ $slider->title }}</a></td>
                  <td>
                    <input data-id="{{ $slider->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $slider->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa hình ảnh" href="{{ route('backend.slider.edit', $slider->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.slider.destroy', $slider->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa hình ảnh"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.slider.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@elseif($segment2 == 'social')
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.social.index') }}">Quản lý hình ảnh</a></li>
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
            <table id="socials" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.social.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Icon</th>
                  <th>Tiêu đề</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sliders as $k => $slider)
                @if($slider->type == 'social')
                <tr id="tr_{{ $slider->id }}">
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $slider->id }}">
                  </td>
                  <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $slider->id }}" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                  </td>
                  <td><a href="{{ route('backend.social.edit', $slider->id) }}">{{ $slider->icon }}</a></td>
                  <td><a href="{{ route('backend.social.edit', $slider->id) }}">{{ $slider->title }}</a></td>
                  <td>
                    <input data-id="{{ $slider->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $slider->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa hình ảnh" href="{{ route('backend.social.edit', $slider->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.social.destroy', $slider->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa hình ảnh"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.social.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@else($segment2 == 'other')
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý hình ảnh
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hình ảnh</a></li>
      <li><a href="{{ route('backend.other.index') }}">Quản lý hình ảnh</a></li>
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
            <table id="sliders" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.other.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
                  <th>Tiêu đề</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sliders as $k => $slider)
                @if($slider->type == 'other')
                <tr id="tr_{{ $slider->id }}">
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{ $slider->id }}">
                  </td>
                  <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $slider->id }}" value="@if(isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                  </td>
                  <td><a href="{{ route('backend.other.edit', $slider->id) }}"><img src="/storage/uploads/{{ $slider->img }}" class="img-thumbnail" style="margin-bottom: 0px; max-width: 50px"></a></td>
                  <td><a href="{{ route('backend.other.edit', $slider->id) }}">{{ $slider->title }}</a></td>
                  <td>
                    <input data-id="{{ $slider->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $slider->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa hình ảnh" href="{{ route('backend.other.edit', $slider->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.other.destroy', $slider->id) }}" onclick="return confirm('Xác nhận Xoá ?')" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xóa hình ảnh"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.other.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endif
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
        alert("Vui lòng check chọn nội dung cần Xoá !");  
      }  else {  
        if(confirm("Xác nhận Xoá tất cả nội dung đã chọn ?")){  
          var strIds = idsArr.join(","); 
          $.ajax({
            @if($segment2 == 'slider')
            url: "{{ route('backend.slider.deletemultiple') }}",
            @elseif($segment2 == 'social')
            url: "{{ route('backend.social.deletemultiple') }}",
            @else($segment2 == 'other')
            url: "{{ route('backend.other.deletemultiple') }}",
            @endif
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

@if($segment2 == "slider")

<script>
function switchChange(){
  $('#sliders').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var slider_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.slider.hideshow') }}',
      data: {'hide_show': hide_show, 'slider_id': slider_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();

  $(function(){
    $('#sliders').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var slider_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.slider.changestt') }}',
        data: {'stt': stt, 'slider_id': slider_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

})
</script>

@elseif($segment2 == "social")

<script>
function switchChange(){
  $('#socials').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var slider_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.social.hideshow') }}',
      data: {'hide_show': hide_show, 'slider_id': slider_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();

  $(function(){
    $('#socials').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var slider_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.social.changestt') }}',
        data: {'stt': stt, 'slider_id': slider_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

})
</script>

@elseif($segment2 == "other")

<script>
function switchChange(){
  $('#sliders').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0; 
    var slider_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.other.hideshow') }}',
      data: {'hide_show': hide_show, 'slider_id': slider_id},
        success: function(data){
        console.log(data.success)
      }
    });
  })
}

$(document).ready(function(){
  switchChange();

  $(function(){
    $('#sliders').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var slider_id = $(this).data('id'); 
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.other.changestt') }}',
        data: {'stt': stt, 'slider_id': slider_id},
        success: function(data){
          console.log(data.success)
        }
      });
    })
  })

})
</script>

@endif

@endpush