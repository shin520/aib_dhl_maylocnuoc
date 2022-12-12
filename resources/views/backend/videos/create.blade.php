@extends('backend.layout.master')
@push('script')
<script>
  $(document).ready(function($) {
   var videobox = document.getElementById('videobox');
   $('#link').on('keyup', function() {
     if($(this).val() === "") {
   videobox.style.display = "none";
     }else{
   var url =$(this).val(); 
   var ifrm = document.createElement('iframe');
   ifrm.src = "//www.youtube.com/embed/"+ url.split("=")[1];
   // ifrm.src = (!url.includes('vimeo')) ? "//www.youtube.com/embed/"+ url.split("=")[1] : "//player.vimeo.com/video/"+ url.split("/")[3];
   ifrm.width= "100%";
   ifrm.height = "200";
   ifrm.frameborder="1";
   ifrm.scrolling="no";
   $('#video-preview').html(ifrm);
   videobox.style.display = "block";
     }
    });
  })
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thêm mới Video
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Hosting</a></li>
      <li><a href="{{ route('video.index') }}">Quản lý Video</a></li>
      <li class="active">Thêm</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form id="stringLengthForm" method="POST" action="{{ route('video.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-7">
              <div class="box box-primary">
                <div class="box-body">
                  <input type="hidden" id="type" name="type" value="video">
                  <div class="form-group">
                    <label>Tên Video</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Video">
                  </div>
                  <div class="form-group">
                    <label>Link Video Youtube</label>
                    <input type="url" name="link" id="link" placeholder="Video URL" value="{{ old('link') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link Video Youtube">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group">
                    <label>Xem trước Video</label>
                    <div id="videobox" style="display: none;">
                        <div class="form-group">
                            <div id="video-preview"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('video.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  <option value="Published" selected="selected">Xuất bản</option>
                  <option value="Pending">Chờ duyệt</option>
                </select>
              </div>
            </div>
          </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>Số thứ tự</label>
          </div>
          <div class="box-body">
            <div class="form-group">
              <input type="number" name="stt" id="stt" value="1" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>
              <input type="checkbox" name="hide_show" id="hide_show" value="1" class="minimal" checked="1"><span style="margin-left: 10px;">Hiển thị</span>
            </label>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>
              <input type="checkbox" name="is_featured" id="is_featured" value="1" class="minimal" checked="1"><span style="margin-left: 10px;">Nổi bật</span>
            </label>
          </div>
        </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <label>Thao tác</label>
        </div>
        <div class="box-body">
          <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
          <a href="{{ route('video.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
        </div>
      </div>
    </div>
    <!-- right column -->
  </div>
</section>
</div>
</form>
@endsection