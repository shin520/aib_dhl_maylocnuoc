@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Cập nhật Tác giả
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Trang tĩnh</a></li>
      <li class="active">Tác giả</li>
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
    <form method="POST" action="{{ route('backend.author.update') }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="author">
              <div class="form-group">
                @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <label>Tên Tác giả</label>
                <input type="text" name="name" id="name" value="@if(isset($author->name)){{ old('name', $author->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Tác giả" >
              </div>
              {{-- <div class="form-group">
                <label>URL Button One</label>
                <input type="text" name="link_group" id="link_group" value="@if(isset($author->link_group)){{ old('link_group', $author->link_group) }}@else{{ old('link_group') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Button One" >
              </div> --}}
              {{-- <div class="form-group">
                <label>URL Button Two</label>
                <input type="text" name="link_author" id="link_author" value="@if(isset($author->link_author)){{ old('link_author', $author->link_author) }}@else{{ old('link_author') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Button Two" >
              </div> --}}
              {{-- <div class="form-group">
                <label>Tên Button One</label>
                <input type="text" name="namebuttonone" id="namebuttonone" value="@if(isset($author->namebuttonone)){{ old('namebuttonone', $author->namebuttonone) }}@else{{ old('namebuttonone') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Tên Button One" >
              </div>
              <div class="form-group">
                <label>Tên Button Two</label>
                <input type="text" name="namebuttontwo" id="namebuttontwo" value="@if(isset($author->namebuttontwo)){{ old('namebuttontwo', $author->namebuttontwo) }}@else{{ old('namebuttontwo') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Tên Button Two" >
              </div> --}}
              <div class="form-group">
                <label>Giới thiệu Tác giả</label>
                <textarea class="form-control" name="content" id="content" value="@if(isset($author->content)){{ old('content', $author->content) }}@else{{ old('content') }}@endif" rows="3">@if(isset($author->content)){{ old('content', $author->content) }}@else{{ old('content') }}@endif</textarea>
              </div>
              <script>
                var editor = CKEDITOR.replace( 'content' );
                CKFinder.setupCKEditor( editor );
              </script>
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
                <img class="img-thumbnail mb-2" style="max-width: 200px; margin-bottom:10px;" src="/storage/uploads/{{ $author->img }}" alt="img">
                <input type="file" name="img" class="form-control" value="{{ $author->img }}">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $author->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
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