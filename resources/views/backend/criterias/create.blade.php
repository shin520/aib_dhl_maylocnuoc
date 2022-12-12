@extends('backend.layout.master')
@push('script')
@endpush
@section('content')
    @php
        $segment2 = Request::segment(2);
    @endphp
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="pjax-container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h4>
                    Thêm mới tiêu chí
                </h4>
                <ol class="breadcrumb">
                    <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                    <li><a>Tiêu chí</a></li>
                    <li><a href="{{ route('backend.criteria.index') }}">Quản lý tiêu chí</a></li>
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
                <form id="stringLengthForm" method="POST" action="{{ route('backend.criteria.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-9">
                            <input type="hidden" id="type" name="type" value="criteria">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập tiêu đề hình ảnh">
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="form-group">
                                      <label>Nội dung bài viết</label>
                                      <textarea class="form-control" name="content" id="content" rows="3">{!! old('content') !!}</textarea>
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
                                    <label>Thao tác</label>
                                </div>
                                <div class="box-body">
                                    <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                    <a href="{{ route('backend.criteria.index') }}" class="btn btn-danger"><i
                                            class="fa fa-times-circle"></i> Thoát</a>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="img" class="form-control">
                                        <div style="padding: 10px 15px">Chọn ảnh có tỉ lệ 1:1 (Hình vuông)</div>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <label>Số thứ tự</label>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="number" name="stt" id="stt" value="1"
                                            class="form-control stt" data-toggle="tooltip" data-placement="top"
                                            title="Nhập số thứ tự">
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <label>
                                        <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                            class="minimal" checked="1"><span style="margin-left: 10px;">Hiển thị</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- right column -->
                    </div>
                </form>
            </section>
        </div>
@endsection
