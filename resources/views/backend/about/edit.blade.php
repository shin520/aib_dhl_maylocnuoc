@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
  $("#title").val(this.value);
  $("#keywords").val(this.value);
  $("#description").val(this.value);
});
</script>
<script>
  var editor = CKEDITOR.replace( 'content' );
  CKFinder.setupCKEditor( editor );
</script>
<script>
  var editor = CKEDITOR.replace( 'content_en' );
  CKFinder.setupCKEditor( editor );
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Cập nhật Trang Giới thiệu
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Trang tĩnh</a></li>
      <li class="active">Giới thiệu</li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.about.update') }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom box box-primary">
               {{--  <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">🇻🇳 Tiếng Việt</a></li>
                  <li><a href="#tab_2" data-toggle="tab">🇬🇧 Tiếng Anh</a></li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul> --}}
                <div class="tab-content">
                  <div class="tab-pane active tab-content-en" id="tab_1">
                    <input type="hidden" id="type" name="type" value="about">
                    <div class="form-group">
                      @if (Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
                      <label>Tên trang</label>
                      <input type="text" name="name" id="name" value="@if(isset($about->name)){{ old('name', $about->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Trang">
                    </div>
                    <div class="form-group">
                      <label>Mô tả</label>
                      <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($about->descriptions)){{ old('descriptions', $about->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($about->descriptions)){{ old('descriptions', $about->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                      <label>Nội dung Giới thiệu</label>
                      <textarea class="form-control" name="content" id="content" value="@if(isset($about->content)){{ old('content', $about->content) }}@else{{ old('content') }}@endif">@if(isset($about->content)){{ old('content', $about->content) }}@else{{ old('content') }}@endif</textarea>
                    </div>
                    {{-- <div class="form-group">
                      <label>Nội dung Giới thiệu</label>
                      <textarea class="form-control" name="content" id="content" value="{{ $about->content }}">{{ $about->content }}</textarea>
                    </div> --}}
                    <label>Tối ưu hoá tìm kiếm (SEO)</label>
                    {{-- <div class="box-header with-border">
                      <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
                    </div> --}}
                    <div class="form-group">
                      <div class="url-seo" id="slug1">{{ $setting->web }}/gioi-thieu.html</div>
                      <div class="title-seo" id="title1">{{ $about->title }}</div>
                      <div class="description-seo" id="descriptions1">{{ $about->descriptions }}</div>
                      <label>Title</label>
                      <input type="text" name="title" id="title" value="@if(isset($about->title)){{ old('title', $about->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề Trang">
                    </div>
                    <div class="form-group">
                      <label>Keywords</label>
                      <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($about->keywords)){{ old('keywords', $about->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá Trang">@if(isset($about->keywords)){{ old('keywords', $about->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="description" id="description" value="@if(isset($about->description)){{ old('description', $about->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($about->description)){{ old('description', $about->description) }}@else{{ old('description') }}@endif</textarea>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                      @if (Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
                      <label>Tên trang</label>
                      <input type="text" name="name_en" id="name_en" value="@if(isset($about->name_en)){{ old('name_en', $about->name_en) }}@else{{ old('name_en') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Trang" >
                    </div>
                    <div class="form-group">
                      <label>Mô tả</label>
                      <textarea class="form-control" name="descriptions_en" id="descriptions_en" value="@if(isset($about->descriptions_en)){{ old('descriptions_en', $about->descriptions_en) }}@else{{ old('descriptions_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($about->descriptions_en)){{ old('descriptions_en', $about->descriptions_en) }}@else{{ old('descriptions_en') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                      <label>Nội dung Giới thiệu</label>
                      <textarea class="form-control" name="content_en" id="content_en" value="@if(isset($about->content_en)){{ old('content_en', $about->content_en) }}@else{{ old('content_en') }}@endif">@if(isset($about->content_en)){{ old('content_en', $about->content_en) }}@else{{ old('content_en') }}@endif</textarea>
                    </div>
                    {{-- <div class="form-group">
                      <label>Nội dung Giới thiệu</label>
                      <textarea class="form-control" name="content" id="content" value="{{ $about->content }}">{{ $about->content }}</textarea>
                    </div> --}}
                    <label>Tối ưu hoá tìm kiếm (SEO)</label>
                    {{-- <div class="box-header with-border">
                      <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
                    </div> --}}
                    <div class="form-group">
                      <div class="url-seo" id="slug1">{{ $setting->web }}/gioi-thieu.html</div>
                      <div class="title-seo" id="title1">{{ $about->title_en }}</div>
                      <div class="description-seo" id="descriptions1">{{ $about->descriptions }}</div>
                      <label>Title</label>
                      <input type="text" name="title_en" id="title_en" value="@if(isset($about->title_en)){{ old('title_en', $about->title_en) }}@else{{ old('title_en') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề Trang">
                    </div>
                    <div class="form-group">
                      <label>Keywords</label>
                      <textarea class="form-control" name="keywords_en" id="keywords_en" value="@if(isset($about->keywords_en)){{ old('keywords_en', $about->keywords_en) }}@else{{ old('keywords_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá Trang">@if(isset($about->keywords_en)){{ old('keywords_en', $about->keywords_en) }}@else{{ old('keywords_en') }}@endif</textarea>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="description_en" id="description_en" value="@if(isset($about->description_en)){{ old('description_en', $about->description_en) }}@else{{ old('description_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($about->description_en)){{ old('description_en', $about->description_en) }}@else{{ old('description_en') }}@endif</textarea>
                    </div>
                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
          <!-- /.row -->
        </div>
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 200px; margin-bottom:10px;" src="/storage/uploads/{{ $about->img }}" alt="img">
                <input type="file" name="img" class="form-control" value="{{ $about->img }}">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $about->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.dashboard.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection