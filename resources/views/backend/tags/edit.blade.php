@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
    $("#slug").val(this.value);
    $("#title").val(this.value);
  });
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Chỉnh sửa Tag
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Bài viết</a></li>
      <li><a href="{{ route('backend.tag.index') }}">Quản lý Tags</a></li>
      <li class="active">Chỉnh sửa Tag</li>
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
    <form method="POST" action="{{ route('backend.tag.update', $tag->id) }}">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tên Tag</label>
                <input type="text" name="name" id="name" value="@if(isset($tag->name)){!! old('name', $tag->name) !!}@else{!! old('name') !!}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Tag">
              </div>
              <div class="form-group">
                <label>Mô tả Tag</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($tag->descriptions)){!! old('descriptions', $tag->descriptions) !!}@else{!! old('descriptions') !!}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Tag">@if(isset($tag->descriptions)){!! old('descriptions', $tag->descriptions) !!}@else{!! old('descriptions') !!}@endif</textarea>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $tag->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
                </label>
              </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="title-seo" id="title1">{{ $tag->name }}</div>
                  <div class="url-seo" id="slug1">{{ route('frontend.home.index') }}/tag/{{ $tag->slug }}.html</div>
                  <div class="description-seo" id="descriptions1">{{ $tag->descriptions }}</div>
                  <label>URL Tag</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($tag->slug)){!! old('slug', $tag->slug) !!}@else{!! old('slug') !!}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Tag">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="@if(isset($tag->title)){!! old('title', $tag->title) !!}@else{!! old('title') !!}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Title Tag">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($tag->keywords)){!! old('keywords', $tag->keywords) !!}@else{!! old('keywords') !!}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho Tag">@if(isset($tag->keywords)){!! old('keywords', $tag->keywords) !!}@else{!! old('keywords') !!}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($tag->description)){!! old('description', $tag->description) !!}@else{!! old('description') !!}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn Tag">@if(isset($tag->description)){!! old('description', $tag->description) !!}@else{!! old('description') !!}@endif</textarea>
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
              <a href="{{ route('backend.tag.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($tag->status == 'Published') {
                    echo '<option value="Published" selected>Xuất bản</option>';
                    echo '<option value="Pending">Chờ duyệt</option>';
                  }else {
                    echo '<option value="Pending" selected>Chờ duyệt</option>';
                    echo '<option value="Published">Xuất bản</option>';
                  }
                  @endphp
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</form>
@endsection