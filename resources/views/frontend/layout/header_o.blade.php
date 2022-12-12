<!DOCTYPE html>
<html lang="{{ $setting->lang }}" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/storage/uploads/{{ $setting->faviconindex }}" />
        <link rel="icon" type="image/png" href="/storage/uploads/{{ $setting->faviconindex }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#142038" />
        <meta name="google" content="notranslate" />
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#142038" />
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Geo Location Meta Tag -->
        <meta name="DC.title" content="{{ $setting->nameindex }}" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.placename" content="{{ $setting->address }}" />
        <meta name="geo.position" content="{{ $setting->latitude }};{{ $setting->longitude }}" />
        <meta name="ICBM" content="{{ $setting->latitude }}, {{ $setting->longitude }}" />
        <meta name="DC.identifier" content="{{ $setting->website }}" />
        <!-- Canonical SEO -->
        <link rel="canonical" href="{{ URL::current() }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="robots" content="{{ $setting->robots }}"/>
        <meta name="googlebot" content="NOODP" />
        <meta name="revisit-after" content="1 days" />
        {!! $setting->googlesiteverification !!}
        <meta name="author" content="{{ $setting->author }}" />
        <meta name="copyright" content="{{ $setting->nameindex }} [{{ $setting->email }}]" />
        <title>{{ $master['title'] }}</title>
        <!--  Social tags. -->
        <meta name="title" content="{{ $master['title'] }}" />
        <meta name="keywords" content="{{ $master['keywords'] }}" />
        <meta name="description" content="{{ $master['description'] }}" />
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ $master['title'] }}" />
        <meta itemprop="description" content="{{ $master['description'] }}" />
        <meta itemprop="image" content="{{ route('frontend.home.index') }}/storage/uploads/
        {{ $master['img'] }}" />
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="{{ $setting->author }}" />
        <meta name="twitter:title" content="{{ $master['title'] }}" />
        <meta name="twitter:description" content="{{ $master['description'] }}" />
        <meta name="twitter:creator" content="{{ $setting->author }}"/>
        <meta name="twitter:image" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $master['img'] }}" />
        <!-- Open Graph data -->
        <meta property="fb:app_id" content="{{ $setting->appidfacebook }}" />
        <meta property="fb:admins" content="{{ $setting->uidfacebookadmin }}" />
        <meta property="og:title" content="{{ $master['title'] }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta property="og:image" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $master['img'] }}" />
        <meta property="og:image:secure_url" content="{{ route('frontend.home.index') }}/storage/uploads/{{ $master['img'] }}" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="675" />
        <meta property="og:image:alt" content="{{ $master['title'] }}" />
        <meta property="og:description" content="{{ $master['description'] }}" />
        <meta property="og:site_name" content="{{ $master['title'] }}" />
        <meta property="og:site_property" content="{{ URL::current() }}" />
        <meta property="og:locale" content="{{ $setting->locale }}" />
        <meta property="article:publisher" content="{{ $setting->website }}" />
        <meta property="article:author" content="{{ route('frontend.author.index') }}" />
        <meta property="blog:published_time" content="{{ $master['created_at'] }}" />
        <meta property="blog:modified_time" content="{{ $master['updated_at'] }}" />
        <meta property="blog:section" content="{{ $master['title'] }}" />
        {{-- @foreach ($blog->tags()->get() as $tag)
        @if($tag->hide_show == 1 && $tag->status == "Published")
        <meta property="blog:tag" content="{{ $tag->name }}" />
        @endif
        @endforeach --}}
        {{-- @foreach ($article->tags()->get() as $tag)
        @if($tag->hide_show == 1 && $tag->status == "Published")
        <meta property="article:tag" content="{{ $tag->name }}" />
        @endif
        @endforeach --}}
        {!! $setting->codehead !!}
        <!-- Fonts and icons -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200&amp;subset=vietnamese" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&amp;subset=vietnamese" rel="stylesheet" type="text/css" /> --}}
        {{-- <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700|Kanit:400,600,700|Mitr:400,600,700|Open+Sans:400,600,700|Quicksand:400,500,700|Roboto:300,400,400i,500,700|Source+Sans+Pro:300,400,600,700&amp;subset=vietnamese"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Kanit:400,600,700|Mitr:400,600,700|Open+Sans:400,600,700|Quicksand:400,500,700|Roboto:300,400,400i,500,700|Source+Sans+Pro:300,400,600,700&amp;subset=vietnamese" rel="stylesheet"> --}}
        <!-- Bootstrap core CSS -->
        <link href="/frontend/bower_components/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        {{-- nav --}}
        <link href="/frontend/assets/css/vendor/vendor.min.css" rel="stylesheet" type="text/css" />
        {{-- <link href="/frontend/assets/css/paper-kit.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href="/frontend/bower_components/fontAwesome/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/bower_components/themify-icons/css/themify-icons.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/bower_components/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/bower_components/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/bower_components/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        {{-- lightbox --}}
        <link href="/frontend/bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet" type="text/css" />
        <link href="/frontend/bower_components/swiper/package/css/swiper.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="/frontend/assets/css/plyr.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

        <link href="/frontend/bower_components/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/frontend/bower_components/lightGallery-master/dist/css/lightgallery.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/frontend/assets/css/animate.css" rel="stylesheet" type="text/css" />

        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" id="theme-styles"> --}}
      {{--   <link rel="stylesheet" href="https://sweetalert2.github.io/styles/styles.css"> --}}
      <!-- hljs core js -->
        <link href="/frontend/assets/css/default.min.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <script src="/frontend/assets/js/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        <!-- Custom CSS -->
        <link href="/frontend/assets/css/style.css" rel="stylesheet" type="text/css" />
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->idanalytics }}"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $setting->idanalytics }}');
        </script>
        @stack('style')
    </head>
        <div class="wrapper">
            <div class="main">
                <div class="section">
                    <!-- Page Content -->
                    {{-- <div class="container"> --}}
                        <!-- Set up your HTML -->
                        {{-- <div class="row"> --}}