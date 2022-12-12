<form action="{{ route('backend.newsletter.store') }}" method="POST">
  @csrf
  @if ($errors->any())
  <div id="error_newsletters" class="alert alert-danger" style="display: none">
    <ul style="padding-left: 0px;">
      @foreach ($errors->all() as $error)
      <li style="line-height: 32px;">{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="input-group">
    <input type="hidden" name="stt" value="1">
    <input type="hidden" name="read" value="0">
    <input type="text" name="email" placeholder="Nhận ưu đãi tại đây !" class="form-control">
    <div class="input-group-btn">
      <button class="btn btn-danger btn-custom btn-order" id="send_newsletter">Đăng ký ngay</button>
    </div>
  </div>
</form>
@push("script")
  <script>
    var has_errors = {{ $errors->count() > 0 ? 'true' : 'false' }};
    if (has_errors) {
      $("#send_newsletter").click(function () {
        Swal.fire({
          title: 'Lỗi... !',
          icon: 'error',
          html: jQuery('#error_newsletters').html(),
          showCloseButton: true,
        })
      });
    }else{
      var msg = '{{ Session::get('Swal.fire') }}';
      var exist = '{{ Session::has('Swal.fire') }}';
      if(exist){
        $("#send_newsletter").click(function () {
            Swal.fire(
              'Thành công !',
              'Chân thành cảm ơn Quý khách !',
              'success');
        });
      }
    }
  </script>

  $("#send_contact").click(function () {
            Swal.fire(
            'Gửi thông tin liên hệ thành công !',
            'Cảm ơn Quý khách !',
            'success');
        });
@endpush