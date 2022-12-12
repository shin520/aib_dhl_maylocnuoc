@extends('backend.layout.master')
@push('script')
<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugcat = CreateSlugCat($(this).val());
      $('div#slugcat').text('{{ $setting->web }}/danh-muc/'+slugcat+'.html');
    });
  });
  function CreateSlugCat(text)
  {
    return text.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
    .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
    .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
    .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
    .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
    .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
    .replace(/đ/gi, 'd')
    .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
    .replace(/\-\-\-\-\-/gi, '-')
    .replace(/\-\-\-\-/gi, '-')
    .replace(/\-\-\-/gi, '-')
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, ''); // Trim - from end of text
  }
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Chỉnh sửa Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.procatone.index') }}">Danh mục Cấp 1</a></li>
      <li class="active">Sửa</li>
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
    <form method="POST" action="{{ route('backend.procatone.update', $procatone->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="productcategory">
              <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" id="name" value="@if(isset($procatone->name)){{ old('name', $procatone->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
              </div>
              <div class="form-group">
                    {{-- <label>Danh mục Cha</label> --}}
                      {{-- <select name="parent_id" id="parent_id" class="form-control select2">
                        <option value="0">None</option>
                        @php
                         showCategories($productcategories,$procatone->parent_id);
                        @endphp
                      </select> --}}
                      {{-- <select class="form-control select2" name="parent_id" multiple="multiple" data-placeholder="Chọn Danh mục"
                        style="width: 100%;">
                        @foreach ($productcategories as $productcat)
                        <option value="{{ $productcat->id }}">{{ $productcat->name }}</option>
                        @endforeach
                      </select> --}}
                    </div>
              <div class="form-group">
                <label>Mô tả danh mục</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($procatone->descriptions)){{ old('descriptions', $procatone->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">@if(isset($procatone->descriptions)){{ old('descriptions', $procatone->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="show_nav" id="show_nav" value="1" {{ $procatone->show_nav == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị menu</span>
                </label>
              </div> --}}
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
              </div>
              <div class="box-body">
                <div class="form-group">

                  <div class="url-seo" id="slugcat">{{ $setting->web }}/danh-muc/{{ $procatone->slug }}.html</div>
                  <div class="title-seo" id="title1">{{ $procatone->title }}</div>                
                  <div class="description-seo" id="descriptions1">{{ $procatone->descriptions }}</div>
                  <label>URL danh mục</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($procatone->slug)){{ old('slug', $procatone->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="@if(isset($procatone->title)){{ old('title', $procatone->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($procatone->keywords)){{ old('keywords', $procatone->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho danh mục">@if(isset($procatone->keywords)){{ old('keywords', $procatone->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($procatone->description)){{ old('description', $procatone->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn danh mục">@if(isset($procatone->description)){{ old('description', $procatone->description) }}@else{{ old('description') }}@endif</textarea>
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
              <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Danh mục Cha</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                  <select name="parent_id" id="parent_id" class="form-control select2">
                    <option value="0">Chọn danh mục</option>
                      @php
                       // showCategories($productcategories);
                       showCategories($productcategories,$product_category_check);
                      @endphp
                  </select>
                </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $procatone->img }}" alt="{{ $procatone->name }}">
                <input type="file" name="img" class="form-control" value="{{ $procatone->img }}">
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($procatone->status == 'Published') {
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
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($procatone->stt)){{ old('stt', $procatone->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $procatone->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $procatone->is_featured == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection
@php
function showCategories($productcategories, $selected, $parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {

            if ($item->id == $selected) {
              echo '<option selected value="'.$item->id.'">'.$char.$item->name.'</option>';
            } else {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
            }
            
            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);
             
            showCategories($productcategories,$selected, $item->id, $char.'—');
        }
    }
}
@endphp