<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="apple-touch-icon" sizes="76x76" href="/storage/uploads/{{ $setting->faviconindex }}" />
		<link rel="icon" type="image/png" href="/storage/uploads/{{ $setting->faviconindex }}" />
		<meta name="google" content="notranslate" />
		<meta name="theme-color" content="#314292" />
		<meta name="msapplication-navbutton-color" content="#314292" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
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
		<link rel="icon" href="/storage/uploads/{{ $setting->faviconindex }}" type="image/x-icon" />
		<!-- Open Graph data -->
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
		<link rel="stylesheet" href="/frontend/assets/css/ionicons.min.css" >

		{{-- <link href="/frontend/assets/css/bootstrap.scss.css" rel="stylesheet" type="text/css" /> --}}

		{{-- CHANGED --}}
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		{{-- END CHANGED --}}

		<link href="/frontend/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/assets/css/base.scss.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/assets/css/style.scss.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/assets/css/style-full.scss.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/assets/css/edit.scss.css" rel="stylesheet" type="text/css" />

		{{-- <link href="/frontend/menu/mmenu.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/menu/demo.css" rel="stylesheet" type="text/css" /> --}}
		
		<link href="/frontend/bower_components/lightbox2/dist/css/lightbox.min.css" rel="stylesheet" type="text/css" />
		<link href="/frontend/bower_components/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
		{{-- <link href="/frontend/assets/css/menu.css" rel="stylesheet" type="text/css" /> --}}
		<link href="/frontend/assets/css/style.css" rel="stylesheet" type="text/css" />
		<script src="/frontend/assets/js/jquery-2.2.3.min.js" type="text/javascript"></script>
		@stack('style')
	</head>