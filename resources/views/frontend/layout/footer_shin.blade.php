<footer class="footer">
    <div class="tt-footer-default tt-color-scheme-02">
        <div class="container">
            @php
                $hotline = $setting->hotline_1;
                $hotline_trim_space = Str::of($hotline)->replace(' ', '');
            @endphp
            <a href="http://zalo.me/{{ $hotline_trim_space }}" class="zalo btn-tooltip" data-toggle="tooltip"
                data-placement="left" data-original-title="Chat Zalo"><img style="vertical-align:inherit;margin-top: 6px;"
                    src="/frontend/images/zalo.png" width="38" alt="icon zalo" title="icon zalo"></a>
            <div class="row">
                <div class="col-md-9">
                    {{-- <div class="tt-newsletter-layout-01">
                        <div class="tt-newsletter">
                            <div class="tt-mobile-collapse">
                                <div class="bnt-baogia">
                                    <a href="/dang-ky-nhan-bao-gia.html"><i class="fa fa-hand-o-right"></i> ĐĂNG KÝ YÊU
                                        CẦU BÁO GIÁ</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-3 d-sm-block d-xs-none">
                    <ul class="tt-social-icon">
                        @foreach ($sliders as $slider)
                            @if ($slider->type == 'social')
                                <li>
                                    <a href="{{ $slider->url }}" target="_blank" rel="nofollow">
                                        {!! $slider->icon !!}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer">
        <div class="container">
            <div class="footer-inner padding-top-25 padding-bottom-10">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-no-mb">
                        <div class="footer-widget">
                            {!! $footer->content !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-mb">
                        <div class="footer-widget">
                            <h3><span>Chính sách</span></h3>
                            <ul class="list-menu">
                                @foreach ($policies as $policy)
                                    <li><a
                                            href="{{ route('frontend.home.index') }}/chinh-sach/{{ $policy->slug . '.html' }}">{{ $policy->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-mb mb-4">
                        <div class="footer-widget">
                            <h3><span>Mạng Xã Hội</span></h3>
                            {{-- <ul class="list-menu" id="post_content">
                <li>
                  @php
                  $about = Str::limit($abouts->content, 250, ' (...)');
                  @endphp
                  {!! $about !!}
                </li>
              </ul> --}}
                            <div class="fb-page"
                                data-href="https://www.facebook.com/T%E1%BB%95ng-kho-l%E1%BB%8Dc-n%C6%B0%E1%BB%9Bc-TaiWan-102938201131502"
                                data-tabs="" data-width="" data-height="" data-small-header="false"
                                data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote
                                    cite="https://www.facebook.com/T%E1%BB%95ng-kho-l%E1%BB%8Dc-n%C6%B0%E1%BB%9Bc-TaiWan-102938201131502"
                                    class="fb-xfbml-parse-ignore"><a
                                        href="https://www.facebook.com/T%E1%BB%95ng-kho-l%E1%BB%8Dc-n%C6%B0%E1%BB%9Bc-TaiWan-102938201131502">Tổng
                                        kho lọc nước TaiWan</a></blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright clearfix">
        <div class="container">
            <div class="inner clearfix">
                <div class="row">
                    <div class="col-sm-12 col-lg-7 col-md-6 text-left">
                        <span>{{ $setting->copyright }}</span>
                    </div>
                    <div class="col text-right">
                        <span>Hôm nay: {{$counter_access['day']}} | Tuần: {{$counter_access['week']}} | Tháng: {{$counter_access['month']}} | Năm: {{$counter_access['year']}} </span>
                    </div>
                </div>
            </div>
            <div class="back-to-top"><i class="fa fa-arrow-circle-up"></i></div>
        </div>
    </div>
    <div id="popupshow"></div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=415286862818674&autoLogAppEvents=1"
        nonce="Q9wYVPWO"></script>
</footer>
<script src="/frontend/assets/js/rx-all-min.js" type="text/javascript"></script>
<script src="/frontend/assets/js/option-selectors.js" type="text/javascript"></script>
<script src="/frontend/assets/js/api.jquery.js" type="text/javascript"></script>
<script src="/frontend/assets/js/owl.carousel.min.js" type="text/javascript"></script>


<script src="/frontend/assets/js/bootstrap.min.js" type="text/javascript"></script>

{{-- CHANGED  --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script> --}}
{{-- END CHANGED --}}

<script src="/frontend/bower_components/lightbox2/dist/js/lightbox.min.js"></script>
<script src="/frontend/assets/js/jquery.form-validator.min.js" type="text/javascript"></script>
<script>
    $.validate({});
</script>
<script src="/frontend/assets/js/main.js" type="text/javascript"></script>
<script src="/frontend/assets/js/wow.min.js" type="text/javascript"></script>
<script src="/frontend/assets/js/some-plugins.js" type="text/javascript"></script>
<script src="/frontend/assets/js/jquery.simplyscroll.js" type="text/javascript"></script>

<script src="/frontend/bower_components/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
        $(this).ekkoLightbox({
            wrapping: false
        });
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    $('#post_content img').addClass('img-fluid');
    $('#post_content').addClass('photos');
    $('#post_content figure a').attr('data-lightbox', 'photos');
    $('#post_content figure a').attr('title', '{{ $master['title'] }}');
    $('#post_content figure a img').attr('title', '{{ $master['title'] }}');
    $('#post_content figure a img').attr('alt', '{{ $master['title'] }}');
    $('#post_content p a').attr('data-lightbox', 'photos');
    $('#post_content p a').attr('title', '{{ $master['title'] }}');
    $('#post_content p a img').attr('title', '{{ $master['title'] }}');
    $('#post_content p a img').attr('alt', '{{ $master['title'] }}');
</script>
<div class="ajax-load">
    <span class="loading-icon">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;"
            xml:space="preserve">
            <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s"
                    repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s"
                    repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s"
                    repeatCount="indefinite" />
            </rect>
            <rect x="8" y="10" width="4" height="10" fill="#333" opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s"
                    dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s"
                    dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s"
                    repeatCount="indefinite" />
            </rect>
            <rect x="16" y="10" width="4" height="10" fill="#333" opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s"
                    dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s"
                    dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s"
                    repeatCount="indefinite" />
            </rect>
        </svg>
    </span>
</div>
<div id="myModal" class="modal fade" role="dialog">
</div>
<script src="/frontend/assets/js/main-index.js" type="text/javascript"></script>
<div class="backdrop__body-backdrop___1rvky"></div>
<div class="c-menu--slide-left">
    <div class="la-scroll-fix-infor-user">
        <div class="la-nav-menu-items">
            <div class="la-title-nav-items">DANH MỤC</div>
            <ul class="la-nav-list-items">
                <li class="ng-scope">
                    <a href="/">Trang chủ</a>
                </li>
                <li class="ng-scope">
                    <a href="/gioi-thieu.html">Giới thiệu</a>
                </li>
                <li class="ng-scope ng-has-child1">
                    <a href="/san-pham.html">Sản phẩm <i class="fa fa-plus fa1" aria-hidden="true"></i></a>
                    <ul class="ul-has-child1">
                        @php
                            $procatones = DB::table('procatones')->get();
                        @endphp
                        @foreach ($procatones as $procatone)
                            <li class="ng-scope ng-has-child2">
                                <a href="{{ route('frontend.home.index') }}/san-pham/{{ $procatone->slug . '.html' }}">{{ $procatone->name }}
                                    <i class="fa fa-plus fa2" aria-hidden="true"></i></a>
                                @php
                                    $procattwos = DB::table('procattwos')
                                        ->where('procatone_id', $procatone->id)
                                        ->get();
                                @endphp
                                @if ($procattwos->isNotEmpty())
                                    <ul class="ng-scope ul-has-child2">
                                        @foreach ($procattwos as $procattwo)
                                            <li>
                                                <a
                                                    href="{{ route('frontend.home.index') }}/san-pham/{{ $procattwo->slug . '.html' }}">{{ $procattwo->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="ng-scope">
                    <a href="/tin-tuc.html">Tin tức</a>
                </li>
                <li class="ng-scope">
                    <a href="/lien-he.html">Liên hệ</a>
                </li>
            </ul>
        </div>
        <div class="la-nav-slide-banner">
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render={{ $setting->site_key }}"></script>
  <script>
    var id_recaptcha = document.getElementById("recaptcha");
   if(id_recaptcha){
       grecaptcha.ready(function() {
       grecaptcha.execute('{{ $setting->site_key }}', {action: 'contact'}).then(function(token) {
          if (token) {
            document.getElementById('recaptcha').value = token;
          }
       });
   });
   }
</script>
<script type="text/javascript">
    WebFontConfig = {
        google: {
            families: ['Roboto:400,500,700']
        },
        custom: {
            families: ['FontAwesome'],
            urls: ['https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css']
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>
<a href="tel:{{ $setting->hotline_1 }}" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon"
    style="left: 0px; bottom: 130px;">
    <div class="suntory-alo-ph-img-circle"><i class="fa fa-phone"></i></div>
    <div class="tel d-sm-block d-xs-none">
        <span class="call-now-new">{{ $setting->hotline_1 }}</span>
    </div>
</a>
<style>
    .fb-livechat,
    .fb-widget {
        display: block
    }

    .ctrlq.fb-button,
    .ctrlq.fb-close {
        position: fixed;
        right: 24px;
        cursor: pointer
    }

    .ctrlq.fb-button {
        z-index: 1;
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+) center no-repeat #0084ff;
        width: 60px;
        height: 60px;
        text-align: center;
        bottom: 24px;
        border: 0;
        outline: 0;
        border-radius: 60px;
        -webkit-border-radius: 60px;
        -moz-border-radius: 60px;
        -ms-border-radius: 60px;
        -o-border-radius: 60px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16);
        -webkit-transition: box-shadow .2s ease;
        background-size: 80%;
        transition: all .2s ease-in-out
    }

    .ctrlq.fb-button:focus,
    .ctrlq.fb-button:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)
    }

    .fb-widget {
        background: #fff;
        z-index: 2;
        position: fixed;
        width: 360px;
        height: 435px;
        overflow: hidden;
        opacity: 0;
        bottom: 0;
        right: 24px;
        border-radius: 6px;
        -o-border-radius: 6px;
        -webkit-border-radius: 6px;
        box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
        -webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
        -moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
        -o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)
    }

    .fb-credit {
        text-align: center;
        margin-top: 8px
    }

    .fb-credit a {
        transition: none;
        color: #bec2c9;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
        text-decoration: none;
        border: 0;
        font-weight: 400
    }

    .ctrlq.fb-overlay {
        z-index: 0;
        position: fixed;
        height: 100vh;
        width: 100vw;
        -webkit-transition: opacity .4s, visibility .4s;
        transition: opacity .4s, visibility .4s;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, .05);
        display: none
    }

    .ctrlq.fb-close {
        z-index: 4;
        padding: 0 6px;
        background: #365899;
        font-weight: 700;
        font-size: 11px;
        color: #fff;
        margin: 8px;
        border-radius: 3px
    }

    .ctrlq.fb-close::after {
        content: 'x';
        font-family: sans-serif
    }
</style>
<div class="fb-livechat">
    <a href="https://www.messenger.com/" target="_blank" title="Chat với chúng tôi!" class="ctrlq fb-button"></a>
</div>
<div class="btn-mobile d-none">
    <ul class="list-inline">
        <li>
            <a href="tel:{{ $setting->hotline_1 }}">
                <span style="font-size:11px;display: block;">
                    <i class="fa fa-phone"></i> Viber - Zalo - Gọi 24/7
                </span>
                <span style="font-weight:bold; text-transform: uppercase;">{{ $setting->hotline_1 }}</span>
            </a>
        </li>
        <li>
            <a href="/dang-ky-nhan-bao-gia.html">
                <span style="font-size:11px;display: block;">
                    Đăng ký
                </span>
                <span style="font-weight:bold; text-transform: uppercase;">Yêu cầu báo giá</span>
            </a>
        </li>
    </ul>
</div>
@stack('script')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".quickviewproduct").click(function() {
            var slug = $(this).data('slug');
            $.ajax({
                url: "{{ route('frontend.quickview') }}",
                method: 'POST',
                data: {
                    slug: slug
                },
                success: function(result) {
                    // console.log(result);
                    $("#popupshow").html(result);
                    $("#popupshow").modal('show');
                }
            })
        });
    });
</script>
</body>

</html>
