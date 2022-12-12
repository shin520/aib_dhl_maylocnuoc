@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Cập nhật thông tin Footer
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Trang tĩnh</a></li>
      <li class="active">Thông tin Footer</li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.footer.update') }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <input type="hidden" id="type" name="type" value="footer">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                @if (Session::has('success'))
                  <div class="alert alert-success">{{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
              </div>
              <div class="form-group">
                <label>Nội dung Footer</label>
                <textarea class="form-control" name="content" id="content" value="@if(isset($footer->content)){{ old('content', $footer->content) }}@else{{ old('content') }}@endif" rows="3">@if(isset($footer->content)){{ old('content', $footer->content) }}@else{{ old('content') }}@endif</textarea>
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

            <label>
              <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $footer->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
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