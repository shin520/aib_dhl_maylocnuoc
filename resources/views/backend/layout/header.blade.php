<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="/storage/uploads/{{ $setting->faviconindex }}">
  <title>{{ $setting->titleadmin }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/backend/bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="/backend/bower_components/datatables.net-bs/css/responsive.dataTables.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/backend/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/backend/bower_components/select2/dist/css/select2.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/backend/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/backend/dist/css/skins/skin-blue.min.css">
  <!-- Image multi upload -->
  <link href="/backend/plugins/jQueryfiler/css/jquery.filer.css" type="text/css" rel="stylesheet" />
  <link href="/backend/plugins/jQueryfiler/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" /> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/assets/css/pace-theme-flash.css">
  <link rel="stylesheet" href="/frontend/assets/css/plyr.css" />
  <link rel="stylesheet" href="/frontend/assets/css/simply_scroll.css" />
  <link rel="stylesheet" href="/backend/assets/css/style.css">
  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @stack('style')
  <script src="{{asset('/backend/plugins/ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('/backend/plugins/ckfinder/ckfinder.js')}}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @php
    $id = auth()->user()->id;
    $img = auth()->user()->img;
    $name = auth()->user()->name;
    $created_at = auth()->user()->created_at;
    // $contactforms = Contactform::count();
    @endphp
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="{{ route('frontend.home.index') }}/administrator" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        {{-- <div class="logo"><a href="index.php" style="display:block;"></a></div> --}}
        <span class="logo-mini" style="font-size: 14px;">VNLAR</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoadmin }}" style="width: 100%;padding: 8px;"></span>
      </a>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="{{ route('frontend.home.index') }}/administrator" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu" data-toggle="tooltip" data-placement="bottom" title="Đơn hàng mới">
              <!-- Menu toggle button -->
              <a href="{{ route('backend.order.index') }}">
                <i class="fa fa-opencart"></i>
                <span class="label label-danger">
                @if(isset($orders)){{ $orders->where("status", 1)->count() }}@else<span>0</span>@endif
              </span>
              </a>
            </li>
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu" data-toggle="tooltip" data-placement="bottom" title="Thư liên hệ mới">
              <!-- Menu toggle button -->
              <a href="{{ route('backend.contactform.index') }}">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">
                @if(isset($contactforms)){{ $contactforms->where("read", 0)->count() }}@else<span>0</span>@endif
              </span>
              </a>
            </li>
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu" data-toggle="tooltip" data-placement="bottom" title="Thư yêu cầu Báo giá mới">
              <!-- Menu toggle button -->
              <a href="{{ route('backend.price.index') }}">
                <i class="fa fa-comment-o"></i>
                <span class="label label-info">
                @if(isset($prices)){{ $prices->where("read", 0)->count() }}@else<span>0</span>@endif
              </span>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a href="{{ route('frontend.home.index') }}" target="_blank">
                <i class="fa fa-globe"></i>
                <span class="hidden-xs">Xem Website</span>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a href="{{ route('frontend.sitemap.index') }}" target="_blank">
                <i class="fa fa-sitemap"></i>
                <span class="hidden-xs">Xem sitemap.xml</span>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <a href="{{ route('logout') }}">
                <i class="fa fa-user-circle"></i>
                <span class="hidden-xs">Đăng xuất</span>
              </a>
            </li>
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                {{--  @foreach ($users as $user) --}}
                <img src="/storage/uploads/{{ $img }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ $name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/storage/uploads/{{ $img }}" class="img-circle" alt="User Image">
                  <p>
                    {{ $name }}
                    <small>Thành viên từ {{ date("d/m/Y", strtotime($created_at)) }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="/administrator/users/{{ $id }}/editinfo" class="btn btn-default btn-flat">Sửa thông tin</a>
                  </div>
                  <div class="pull-right">
                    <a href="/administrator/users/{{ $id }}/editpassword" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>