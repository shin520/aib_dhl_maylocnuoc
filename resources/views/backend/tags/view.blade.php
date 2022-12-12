@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thông tin Tags
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Blogs</a></li>
      <li><a href="{{ route('backend.tag.index') }}">Quản lý Tags</a></li>
      <li class="active">Xem Tags</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          @if (Session::has('success'))
          <div class="alert alert-success">{{ Session::get('success') }}</div>
          @endif
          <div class="box-body" style="overflow-y: hidden;overflow-x: scroll;width: 100%;">
            <table id="tags" class="table table-bordered table-striped">
              <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom">Thêm mới</a>
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Tên Tags</th>
                  <th>Tên bài viết có Tags</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox">
                    </label>
                  </td>
                  <td>
                    {{ $tag->id }}
                  </td>
                  <td>
                    <span class="badge bg-green">{{ $tag->name, $tag->id }}</span>
                  </td>
                  <td>
                    @foreach ($tag->articles()->get() as $article)
                    <li><a href="{{ route('backend.article.edit', $article->id ) }}">{!! $article->name !!}</a></li>
                    @endforeach
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa Tag" href="{{ route('backend.tag.edit', $tag->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.tag.destroy', $tag->id) }}" onclick="return confirm('Are you sure? Delete ')" style="display: inline; margin-left: 8px;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Xoá Tag"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom">Thêm mới</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection