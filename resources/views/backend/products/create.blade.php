@extends('backend.layout.master')
@push('script')
{{-- <script>
  $(document).ready(function() {
     // $('#filer_input').filer();       
     $('#filer_input2').filer();       
});
</script> --}}

<script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
    $("#keywords").val(this.value);
    $("#description").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ $setting->web }}/san-pham/'+slug1+'.html');
    });
  });
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slug1 = createslug($(this).val());
      $('div#slug1').text('{{ $setting->web }}/san-pham/'+slug1+'.html');
    });
  });
  function createslug(text)
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
{{-- <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script> --}}
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
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Thêm mới Sản phẩm
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.product.index') }}">Quản lý Sản phẩm</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.product.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="product">
              <div class="form-group">
                <label>Tên Sản phẩm</label>
                <input type="text" name="name" id="name" onkeyup="AutoSlug();"{{-- onchange="getTitle()" --}} value="{{ old('name') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên sản phẩm">
              </div>
              <div class="form-group">
                {{-- <label>Danh mục Cha</label> --}}
                  {{-- <select name="productcategories_id[]" id="productcategories_id[]" class="form-control select2">
                    <option value="0">None</option>
                    @php
                     showCategories($productcategories);
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
                   <label>Danh mục Cấp 1</label>
                   <select class="form-control select2 choose procatone" name="procatone" id="procatone" style="width: 100%;">
                     <option value="">Chọn</option>
                     @foreach($procatones as $key => $procatone)
                     <option value="{{ $procatone->id }}">{{ $procatone->name }}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                   <label>Danh mục Cấp 2</label>
                   <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo" style="width: 100%;">
                     <option value="">Chọn</option>
                   </select>
                 </div>
                 {{-- <div class="form-group">
                   <label>Danh mục cấp 3</label>
                   <select class="form-control select2 procatthree" name="procatthree" id="procatthree" style="width: 100%;">
                     <option value="">Chọn</option>
                   </select>
                 </div> --}}
              <div class="form-group">
                <label>Mã Sản phẩm</label>
                <input type="text" name="product_code" id="product_code" {{-- onchange="getTitle()" --}} value="{{ old('product_code') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên sản phẩm">
              </div>
              <div class="form-group">
                <label>Giá sản phấm (₫)</label>
                <input type="text" name="price" id="price" onchange="numberWithCommas();" value="{{ old('price') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập giá sản phẩm">
              </div>
              <div class="form-group">
                <label>Giảm giá (%)</label>
                <input type="number" name="discount" id="discount" {{-- onchange="numberWithCommas();" --}} value="{{ old('discount') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập % giảm giá">
              </div>
              <input type="hidden" id="selling_price" name="selling_price" value="selling_price">
              <div class="form-group">
                <label>Hình ảnh liên quan</label>
              {{-- <input type="file" name="imgs[]" id="filer_input2" multiple/> --}}
              <input type="file" class="form-control" name="imgs[]" multiple/>
              </div>
              
              {{-- <div class="input-group control-group increment" >
                <input type="file" name="imgs[]" class="form-control" multiple>
                <div class="input-group-btn">
                  <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
              </div> --}}
              {{-- <div class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                  <input type="file" name="imgs[]" class="form-control">
                  <div class="input-group-btn">
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                  </div>
                </div>
              </div> --}}
              
              <br>
              <div class="form-group">
                <label>Mô tả sản phẩm</label>
                <textarea class="form-control" name="descriptions" id="descriptions" onchange="getDescription()" value="{{ old('descriptions') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn sản phẩm">{{ old('descriptions') }}</textarea>
                {{-- <script>
                  CKEDITOR.replace('descriptions');
                </script> --}}
                <script>
                  var editor = CKEDITOR.replace( 'descriptions' );
                  CKFinder.setupCKEditor( editor );
                </script>
              </div>
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="is_featured" id="is_featured" value="1" class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
                </label>
              </div> --}}
              {{-- <div class="form-group">
                <label>
                  <input type="checkbox" name="hide_show" id="hide_show" value="1" class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
                </label>
              </div> --}}
              <div class="form-group">
                <label>Nội dung sản phẩm</label>
                <textarea class="form-control" name="content" id="content" rows="3">{!! old('content') !!}</textarea>
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
                  <div class="url-seo" id="slug1"></div>
                  <div class="title-seo" id="title1"></div>
                  <div class="description-seo" id="descriptions1"></div>
                  <label>URL sản phẩm</label>
                  <input type="text" type="text" name="slug" id="slug" oninput="getUrl()" onchange="getUrl()" value="{{ old('slug') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL sản phẩm">
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề sản phẩm">
                </div>
                <div class="form-group">
                  <label>Keywords</label>
                  <textarea class="form-control" name="keywords" id="keywords" value="{{ old('keywords') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho sản phẩm">{{ old('keywords') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn sản phẩm">{{ old('description') }}</textarea>
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
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>Hình ảnh đại diện</label>
          </div>
          <div class="box-body">
            <div class="form-group">
              <input type="file" name="img" class="form-control">
              <div style="padding: 10px 15px; font-weight: normal; font-size: 9px;">Chọn ảnh có tỉ lệ 1:1 (Hình vuông)</div>
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
              <input type="checkbox" name="is_new" id="is_new" value="1" class="minimal"><span style="margin-left: 10px;">Mới</span>
            </label>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>
              <input type="checkbox" name="is_featured" id="is_featured" value="1" class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
            </label>
          </div>
        </div>
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
  </div>
</section>
</div>
</form>
@endsection
@php
function showCategories($productcategories, $parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($productcategories, $item->id, $char.'—');
        }
    }
}
@endphp