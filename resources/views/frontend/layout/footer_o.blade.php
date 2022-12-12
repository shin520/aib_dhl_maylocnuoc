{{-- </div> --}}
                    <!-- /.row -->
                {{-- </div> --}}
                <!-- /.container -->
    </div>
  </div>
</div>
<!-- Footer -->
<footer class="footer footer-black footer-big" id="footer">
  <div class="container">
    <div class="row">
      <div class="scrollup" style="display: block;"><i class="ti-upload"></i></div>
      @php
      $hotline = $setting->hotline_1;
      $hotline_trim_space = Str::of($hotline)->replace(' ', '');
      @endphp
      <a href="http://zalo.me/{{ $hotline_trim_space }}" class="zalo btn-tooltip" data-toggle="tooltip" data-placement="left" data-original-title="Chat Zalo">
        <img style="vertical-align: inherit;" src="/frontend/images/Zalo-icon.png" width="26" alt="icon zalo" title="icon zalo">
      </a>
      <div class="view__buy__cart" style="position: relative">
        <a href="{{ route('order.view') }}" class="view__cart btn-tooltip" data-toggle="tooltip" data-placement="left" data-original-title="Xem giỏ hàng">
          <i class="fas fa-cart-plus" style="position: absolute;top: 18px;left: 16px;"></i><span class="badge badge-pill badge-success" style="position: absolute">{{ $order->total_quantity }}</span>
          {{-- <img style="vertical-align: inherit;" src="/frontend/images/Zalo-icon.png" width="26" alt="Xem giỏ hàng" title="Xem giỏ hàng"> --}}
        </a>
      </div>
      
      <a href="{{ $setting->href_1 }}" class="hot-phone btn-tooltip" data-toggle="tooltip" data-placement="right" data-original-title="Gọi"><img style="vertical-align: inherit;" src="/frontend/images/phone.png" width="26" alt="icon hotline" title="icon hotline"></a>
      <div class="col-md-4">
        <div class="title-main-footer">
          <h3>THÔNG TIN LIÊN HỆ</h3>
        </div>
        <div class="info-com">
          {!! $footer->content !!}
        </div>
      </div>
      <div class="col-md-3">
        <div class="title-main-footer">
          <h3>THỰC ĐƠN</h3>
        </div>
        <div class="procats">
          <ul>
            @foreach($procats as $procat)
            <li><a href="{{ route('frontend.home.index') }}/menu/{{ $procat->slug.'.html' }}">{{ $procat->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-5 mb-3">
        <div class="title-main-footer">
          <h3>MADAM SÀI GÒN TRÊN FACEBOOK</h3>
        </div>
        <div class="fb-page"
          data-href="https://www.facebook.com/Madam-S%C3%A0ig%C3%B2n-105039881230610"
          data-width="500"
          data-hide-cover="false"
          data-show-facepile="false">
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <form action="{{ route('backend.newsletter.store') }}" method="POST">
          @csrf
          <div class="input-group">
            <input type="hidden" name="stt" value="1">
            <input type="hidden" name="read" value="0">
            <input type="text" name="email" placeholder="Nhận ưu đãi tại đây !" class="form-control">
            <div class="input-group-btn">
              <button class="btn btn-danger btn-custom btn-order" id="send_email">Đăng ký ngay</button>
            </div>
          </div>
        </form>
        <div class="social-follow-us mt-3 mb-3">
          <span style="color: #ffffff;">Kết nối với Madam Saigon</span>
          <div class="social-icon-group" style="display: inline;">
            @foreach($sliders as $slider)
            @if($slider->type == 'social')
            <a href="{{ $slider->url }}" class="social" target="_blank" rel="nofollow">
              {!! $slider->icon !!}
            </a>
            @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="brand-logo">
          <div class="logo-protected-group text-right mb-3">
            @foreach($sliders as $slider)
            @if($slider->type == 'other')
            <a href="{{ $slider->url }}" title="{{ $slider->title }}" target="_blank" rel="nofollow">
              <img src="/storage/uploads/{{ $slider->img }}" height="24" alt="{{ $slider->title }}" title="{{ $slider->title }}">
            </a>
            @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  @if($footer->hide_show == 1)
  <div class="row">
    <div class="col-12 text-center">
      <div class="info-company">
        Copyright © <script>document.write(new Date().getFullYear())</script>{{-- {{ $setting->copyright }} --}}. All Rights Reserved. Design by <a href="https://vnlar.vn" style="color: #fffdee">VNLAR.VN</a>
      </div>
    </div>
  </div>
  @endif
</footer>
</div>
</div>
</footer>
<script src="/frontend/bower_components/jquery/dist/jquery.min.js"></script>
{{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script> --}}
<script src="/frontend/assets/js/popper.min.js"></script>
<script src="/frontend/bower_components/bootstrap4/dist/js/bootstrap.min.js"></script>
<script src="/frontend/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/frontend/bower_components/swiper/package/js/swiper.min.js"></script>
<script src="/frontend/assets/js/plyr.js"></script>
<script src="/frontend/assets/js/plyr.js"></script>
<script src="/frontend/bower_components/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
{{-- <script src="/frontend/bower_components/lightGallery-master/dist/js/lightgallery.min.js" type="text/javascript"></script>
<script src="/frontend/bower_components/lightGallery/static/prettify.js"></script>
<script src="/frontend/bower_components/lightGallery/static/jquery.justifiedGallery.min.js"></script>
<script src="/frontend/bower_components/lightGallery/static/transition.js"></script>
<script src="/frontend/bower_components/lightGallery/static/collapse.js"></script>
<script src="/frontend/bower_components/lightGallery/lightgallery.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-fullscreen.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-thumbnail.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-video.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-autoplay.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-share.js"></script>
<script src="/frontend/bower_components/lightGallery/lg-zoom.js"></script>
<script src="/frontend/bower_components/lightGallery/external/jquery.mousewheel.min.js"></script>
<script src="/frontend/bower_components/lightGallery/static/demos.js"></script> --}}
{{-- Displaying The Validation Errors --}}
<script src="/frontend/assets/js/sweetalert2@9.js"></script>
{{-- <script>
  new WOW().init();
</script> --}}
{{-- <script>
  $(document).ready(() => {
    $("#lightgallery").lightGallery({
      pager: true
    });
  });
</script>
<script>
  $('#aniimated-thumbnials').lightGallery({
      thumbnail:true
  }); 
</script> --}}
<script>
  @if($errors->any())
    @foreach ($errors->all() as $error)
      Swal.fire({
        icon: 'error',
        title: 'Lỗi...',
        text: '{{ $error }}',
      });
    @endforeach
  @endif
    var msg = '{{ Session::get('Swal.fire') }}';
    var exist = '{{ Session::has('Swal.fire') }}';
    if(exist){
      Swal.fire(
        'Thành công !',
        'Chân thành cảm ơn Quý khách !',
        'success');
    }
</script>
<script>
  const players = Array.from(document.querySelectorAll('.plyr__video-embed'));
      players.map(player => new Plyr(player, {
        debug:false,
          autoplay: false,
          ratio: '16:9'
    }));
    
    players.forEach(function(player) {
      window.addEventListener("load", function() {
      //player.pause();
        // setTimeout(() => { player.pause() }, 10);
      })
    });
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill9/dist/polyfill.js"></script> --}}
<script>
    $(function() {
      function close() {
        $('body').removeClass('has-active-menu');
        setTimeout(function(){
          $('.nav-slider').removeClass('toggling');
        }, 500);
      }
      function open() {
        $('body').addClass('has-active-menu');
        $('.nav-slider').addClass('toggling');
      }
      
      $('.nav-mask').click(close);
      $('.navbar-toggler').click(open);
    });
</script>
<script>
    var slider = new Swiper('.slider', {
      autoHeight: false,
      effect: 'fade',
      loop: true,
      autoplay: {
        delay: 3000,
                },
      spaceBetween: 20,
      pagination: {
        el: '.swiper-pagination-slider',
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: '.swiper-button-next-slider',
        prevEl: '.swiper-button-prev-slider',
      },
    });
    var customer = new Swiper('.swiper-container-cus', {
      slidesPerView: 1,
      spaceBetween: 10,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 1,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      }
    });
    var customer = new Swiper('.swiper-container-news', {
      slidesPerView: 1,
      spaceBetween: 10,
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      }
    });
    var customer = new Swiper('.swiper-container-videos', {
      slidesPerView: 1,
      spaceBetween: 10,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      }
    });
</script>
<script>
  $(document).ready(function(){
    $(".owl-carousel").owlCarousel();
  });
</script>
<script>
  $(document).ready(function() {
      var ix = 1;
      setInterval(function() {
          var step = '.step' + ix;
          $('.step-img img').removeClass('active');
          $(step + ' img').addClass('active');
          ix++;
          if (ix == 6) {
              ix = 1;
          }
      }, 1000);
    });
</script>
<script>
  $(document).ready(function() {
      var ix = 1;
      setInterval(function() {
          var step = '.steps' + ix;
          $('.step-imgs span').removeClass('actives');
          $(step + ' span').addClass('actives');
          ix++;
          if (ix == 6) {
              ix = 1;
          }
      }, 1000);
    });
</script>
<script src="/frontend/assets/js/paper-kit.min.js"></script>
<script type="text/javascript">
    function before_search(){
        var searchVal = 'site:{{ route('frontend.home.index') }} ' + document.getElementById('search_input').value;
        document.getElementById('search_q').value = searchVal;
        return true;
    }
</script>
<script>
  $(function () {
    $('[data-toggle="offcanvas"]').on('click', function () {
      $('.offcanvas-collapse').toggleClass('open')
    })
  })
</script>
{{-- <script src="/frontend/assets/js/disable-copyright.js"></script> --}}
<!-- wow JS -->
<script src="/frontend/assets/js/wow.min.js"></script>
<!-- Some plugins JS -->
<script src="/frontend/assets/js/some-plugins.js"></script>

<!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

<!-- Main JS -->
<script src="/frontend/assets/js/main.js"></script>

<script src="/frontend/assets/js/script.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=2054578154833459&autoLogAppEvents=1"></script>
@stack('script')
{!! $setting->codebody !!}
</body>
</html>