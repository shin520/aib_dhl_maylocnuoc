@extends('backend.layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    Chỉnh sửa Sản phẩm
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.product.index') }}">Quản lý Sản phẩm</a></li>
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
    <div class="row">
      <!-- left column -->
      <div class="col-md-9">
        <form method="POST" action="{{ route('backend.product.update', $product->id) }}" enctype="multipart/form-data">
          @csrf
          {{ method_field('PUT') }}
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="product">
              <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" id="name" value="@if(isset($product->name)){{ old('name', $product->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên sản phẩm">
                {{--  @if(isset($news->name)){{ old('name', $news->name) }}@else{{old('name')}}@endif --}}
              </div>
              {{-- <div class="form-group">
                <label>Danh mục Cha</label>
                  <select name="productcategories_id[]" id="productcategories_id[]" class="form-control select2">
                    <option value="0">None</option>
                    @php
                     showCategories($productcategories,$product_category_selected->productcategory_id);
                    @endphp
                  </select>
              </div> --}}
              <div class="form-group">
                <label>Danh mục Cấp 1</label>
                <select class="form-control select2 choose procatone" name="procatone" id="procatone" style="width: 100%;">
                  <option value="">Chọn</option>
                  @foreach($procatones as $key => $procatone)
                  <option value="{{ $procatone->id }}" {{ ($product->procatone_id == $procatone->id) ? 'selected' : '' }}>{{ $procatone->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Danh mục Cấp 2</label>
                <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo" style="width: 100%;">
                  <option value="">Chọn</option>
                  @foreach($procattwos as $key => $procattwo)
                  <option value="{{ $procattwo->id }}" {{ ($product->procattwo_id == $procattwo->id) ? 'selected' : '' }}>{{ $procattwo->name }}</option>
                  @endforeach
                </select>
              </div>
              {{-- <div class="form-group">
                <label>Danh mục cấp 3</label>
                <select class="form-control select2 procatthree" name="procatthree" id="procatthree" style="width: 100%;">
                  <option value="">Chọn</option>
                  @foreach($procatthrees as $key => $procatthree)
                  <option value="{{ $procatthree->id }}" {{ ($product->procatthree_id == $procatthree->id) ? 'selected' : '' }}>{{ $procatthree->name }}</option>
                  @endforeach
                </select>
              </div> --}}
              <div class="form-group">
                <label>Mã sản phẩm</label>
                <input type="text" name="product_code" id="product_code" value="@if(isset($product->product_code)){{ old('product_code', $product->product_code) }}@else{{ old('product_code') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên sản phẩm">
              </div>
              <div class="form-group">
                <label>Giá sản phẩm (₫)</label>
                <input type="text" name="price" id="price" value="@if(isset($product->price)){{ old('price', product_price_view($product->price)) }}@else{{ old('price') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập giá sản phẩm">
              </div>
              <div class="form-group">
                <label>Giảm giá (%)</label>
                <input type="number" name="discount" id="discount" value="@if(isset($product->discount)){{ old('discount', $product->discount) }}@else{{ old('discount') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập % giảm giá">
              </div>
              <label>Thêm hình ảnh</label>
              <input type="file" class="form-control" name="imgs[]" style="margin-bottom: 10px" multiple/>
              </input>
              <label>Hình ảnh hiện tại</label>
                <div class="box-body">
                  <div class="form-group product-img">
                    <div class="row">
                    @foreach($images as $image)
                    <div class="col-xs-6 col-sm-4 col-md-2 mb-2" style="text-align: center;">
                      <img src="/storage/products/{{ $image->imgs }}" alt="product image" width="100" class="img-thumbnail mx-md-auto">
                      <a data-toggle="tooltip" class="delete-img" data-id="{{ $image->id }}" data-placement="top" title="Xoá"><i class="fa fa-trash"></i>
                      </a>
                    </div>
                    @endforeach
                    </div>
                  </div>
                </div>
              <div class="form-group">
                <label>Mô tả sản phẩm</label>
                <textarea class="form-control" name="descriptions" id="descriptions" value="@if(isset($product->descriptions)){{ old('descriptions', $product->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn sản phẩm">@if(isset($product->descriptions)){{ old('descriptions', $product->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
                <script>
                  var editor = CKEDITOR.replace( 'descriptions' );
                  CKFinder.setupCKEditor( editor );
                </script>
              </div>
              
              {{--  @foreach($dataimg as $item)
              {{ $item->id }}
              <?php foreach (json_decode($item->imgs) as $img) { ?>
              <img src="/storage/uploads/{{ $img }}" style="height:120px; width:200px"/>
              <?php } ?>
              @endforeach --}}
              {{-- @foreach($json as $item)
              <img src="/storage/uploads/{{ $item }}" width="80" height="auto" alt="">
              @endforeach --}}
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $product->is_featured == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
                </label>
              </div> --}}
              <div class="form-group">
                <label>Nội dung sản phẩm</label>
                <textarea class="form-control" name="content" id="content" rows="3">@if(isset($product->content)){{ old('content', $product->content) }}@else{{ old('content') }}@endif</textarea>
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
                  <div class="url-seo" id="slug1">{{ route('frontend.home.index') }}/san-pham/{{ $product->slug }}.html</div>
                  <div class="title-seo" id="title1">{{ $product->title }}</div>
                  <div class="description-seo" id="descriptions1">{{ $product->descriptions }}</div>
                  <label>URL sản phẩm</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($product->slug)){{ old('slug', $product->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL sản phẩm">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="@if(isset($product->title)){{ old('title', $product->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề sản phẩm">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="@if(isset($product->keywords)){{ old('keywords', $product->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho sản phẩm">@if(isset($product->keywords)){{ old('keywords', $product->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="@if(isset($product->description)){{ old('description', $product->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn sản phẩm">@if(isset($product->description)){{ old('description', $product->description) }}@else{{ old('description') }}@endif</textarea>
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
              <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Chọn ngày xuất bản</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="published" value="{{ $product->published }}">
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Danh mục</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="productcategories_id[]" multiple="multiple" data-placeholder="Chọn Danh mục"
                  style="width: 100%;">
                  @foreach ($productcategories as $productcategory)
                  <option value="{{ $productcategory->id }}" 
                    {{ $product->productcategories->contains($productcategory->id) ? 'selected' : '' }}>{{ $productcategory->name }}</option>
                  @endforeach
                  <option value="0">Chọn danh mục</option>
                  @php
                   showCategories($productcategories);
                  @endphp
                </select>

                @php 
                  recursiveCheckbox ($productcategories,$id_category);
                @endphp
              </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="/storage/uploads/{{ $product->img }}" alt="{{ $product->name }}">
                <input type="file" name="img" class="form-control" value="{{ $product->img }}">
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
                  if ($product->status == 'Published') {
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
                <input type="number" name="stt" id="stt" value="@if(isset($product->stt)){{ old('stt', $product->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hide_show" value="1" {{ $product->hide_show == 1 ? 'checked' : '' }} id="hide_show">
                <label class="form-check-label" for="defaultCheck1">
                  Hiển thị
                </label>
              </div>
             {{--  <label>
                <input type="checkbox" name="hide_show" value="1" {{ $product->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label> --}}
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_new" value="1" {{ $product->is_new == 1 ? 'checked' : '' }} id="is_new">
                <label class="form-check-label" for="defaultCheck1">
                  Mới
                </label>
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $product->is_featured == 1 ? 'checked' : '' }} id="is_featured">
                <label class="form-check-label" for="defaultCheck1">
                  Nổi bật
                </label>
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thay đổi Tags</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="tags_id[]" multiple="multiple" data-placeholder="Chọn Tags"
                  style="width: 100%;">
                  @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}" {{ $product->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          
        </div>
        <!-- right column -->
      </form>
    </div>
    
  </section>
</div>
@endsection
@push('script')
<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slug1 = CreateSlugProduct($(this).val());
      $('div#slug1').text('{{ $setting->web }}/san-pham/'+slug1+'.html');
    });
  });
  function CreateSlugProduct(text)
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
<script>
  $('input#old_price').keyup(function(event) {
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });
  $('input#price').keyup(function(event) {
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });
  $('input#prices').keyup(function(event) {
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;
    // format number
    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  });
</script>
<script>
  $(".delete-img").click(function(e){
      e.preventDefault();
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax(
      {
          url: "/administrator/products/"+id+"/delete",
          type: 'DELETE',
          data: {
              "id": id,
              "_token": token,
          },
            success: function (data) {
            if (data['status']==true) { // if true (1)
            setTimeout(function(){ // wait for 3 secs(2)
            location.reload(); // then reload the page.(3)
            }, 1000);
            alert(data['message']);
            } else {
            alert('Rất tiếc, đã có lỗi xảy ra !');
            }
            },
            error: function (data) {
            alert(data.responseText);
            }
      });
  });
</script>

<script>
  $(document).ready(function(){
    $('.choose').on('change',function(){
      var action  = $(this).attr('id');
      var code_id = $(this).val();
      var _token  = $('input[name="_token"]').val();
      var result  = '';
      // alert(action);
      // alert(code_id);
      // alert(_token);
      if (action == 'procatone'){
        result = 'procattwo';
      }else{
        result = 'procatthree';
      }
      $.ajax({
        url : '{{ route('backend.product.select_option') }}',
        method : 'POST',
        data: {action:action,code_id:code_id,_token:_token},
        success:function(data){
          $('#'+result).html(data);
        }
      });
    });
  })
</script>

@endpush
@php
function showCategories($productcategories, $selected,$parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            $selected_check = ($item->id == $selected) ? 'selected="selected"' : '';
            echo '<option '.$selected_check.' value="'.$item->id.'">'.$char.$item->name.'</option>';
          
            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($productcategories, $selected,$item->id, $char.'—');
        }
    }
}
@endphp