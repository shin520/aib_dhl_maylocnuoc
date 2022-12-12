@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
    $("#keywords").val(this.value);
    $("#description").val(this.value);
  });
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Cập nhật Trang Liên hệ
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Trang tĩnh</a></li>
      <li class="active">Liên hệ</li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.contact.update') }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="contact">
              <div class="form-group">
                @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <label>Tên trang</label>
                <input type="text" name="name" id="name" value="@if(isset($contact->name)){{ old('name', $contact->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Trang">
              </div>
              <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($contact->descriptions)){{ old('descriptions', $contact->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($contact->descriptions)){{ old('descriptions', $contact->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
              <div class="form-group">
                <label>Nội dung Liên hệ</label>
                <textarea class="form-control" name="content" id="content" rows="3">@if(isset($contact->content)){!! old('content', $contact->content) !!}@else{!! old('content') !!}@endif</textarea>
              </div>
              <script>
                var editor = CKEDITOR.replace( 'content' );
                CKFinder.setupCKEditor( editor );
              </script>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slug1">{{ $setting->web }}/lien-he.html</div>
                  <div class="title-seo" id="title1">{{ $contact->title }}</div>
                  <div class="description-seo" id="descriptions1">{{ $contact->descriptions }}</div>
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="@if(isset($contact->title)){{ old('title', $contact->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề Trang">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($contact->keywords)){{ old('keywords', $contact->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá Trang">@if(isset($contact->keywords)){{ old('keywords', $contact->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($contact->description)){{ old('description', $contact->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Trang">@if(isset($contact->description)){{ old('description', $contact->description) }}@else{{ old('description') }}@endif</textarea>
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
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 200px; margin-bottom:10px;" src="/storage/uploads/{{ $contact->img }}" alt="img">
                <input type="file" name="img" class="form-control" value="{{ $contact->img }}">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $contact->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
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