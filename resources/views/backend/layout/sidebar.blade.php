<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  @php
  // $id = auth()->user()->id;
  // $img = auth()->user()->img;
  // $name = auth()->user()->name;
  // $created_at = auth()->user()->created_at;
  @endphp
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      @php
      $segment1 = Request::segment(1);
      $segment2 = Request::segment(2);
      $segment3 = Request::segment(3);
      $segment4 = Request::segment(4);
      @endphp
      <li class="{{ $segment1 == 'administrator' && $segment2 == ''  ? 'menu-open active' : '' }}"><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-tachometer"></i> <span>Trang chủ</span></a></li>
      <li class="treeview {{ $segment2 == 'about' || $segment2 == 'design' || $segment2 == 'indexservice' || $segment2 == 'contact' || $segment2 == 'author' || $segment2 == 'footer' ? 'menu-open active' : '' }}">
        <a href="#"><i class="fa fa-file-text"></i> <span>Trang tĩnh</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="{{ $segment2 == 'about' || $segment2 == 'design' || $segment2 == 'indexservice' || $segment2 == 'contact' || $segment2 == 'author' || $segment2 == 'footer' ? 'display:block' : '' }}">
          <li {{ $segment2 == 'about' && $segment3 == 'edit' ? 'class=active' : '' }}><a href="{{ route('backend.about.edit') }}"><i class="fa fa-angle-right"></i>Giới thiệu</a></li>
          <li {{ $segment2 == 'contact' && $segment3 == 'edit' ? 'class=active' : '' }}><a href="{{ route('backend.contact.edit') }}"><i class="fa fa-angle-right"></i>Liên hệ</a></li>
          <li {{ $segment2 == 'footer' && $segment3 == 'edit' ? 'class=active' : '' }}><a href="{{ route('backend.footer.edit') }}"><i class="fa fa-angle-right"></i>Thông tin Footer</a></li>
          <li {{ $segment2 == 'author' && $segment3 == 'edit' ? 'class=active' : '' }}><a href="{{ route('backend.author.edit') }}"><i class="fa fa-angle-right"></i>Logo khách hàng</a></li>
        </ul>
      </li>
    </ul>
    <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'orders' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.order.index") }}"><i class="fa fa-opencart"></i> <span>Đơn hàng<span class="label label-cus label-danger label-success-cus">
          @if(isset($orders)){{ $orders->where("status", 1)->count() }}@else<span>0</span>@endif
          </span></span>
        </a>
      </li>
    </ul>
    {{-- <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'newsletters' ? 'menu-open active' : '' }}">
        <a href="{{ route("newsletter.index") }}"><i class="fa fa-at"></i> <span>Newsletters<span class="label label-cus bg-yellow label-success-cus">
          @if(isset($newsletters)){{ $newsletters->where("read", 0)->count() }}@else<span>0</span>@endif
          </span></span>
        </a>
      </li>
    </ul> --}}
    <!-- /.category-menu -->
    <ul class="sidebar-menu">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'contactforms' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.contactform.index") }}"><i class="fa fa-folder-open"></i> <span>Liên hệ<span class="label label-cus label-success label-success-cus">
          @if(isset($contactforms)){{ $contactforms->where("read", 0)->count() }}@else<span>0</span>@endif
          </span></span>
        </a>
      </li>
    </ul>
    {{-- <ul class="sidebar-menu">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'prices' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.price.index") }}"><i class="fa fa-comment"></i> <span>Báo giá<span class="label label-cus label-info label-success-cus">
          @if(isset($prices)){{ $prices->where("read", 0)->count() }}@else<span>0</span>@endif
          </span></span>
        </a>
      </li>
    </ul> --}}
    <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'policies' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.policy.index") }}"><i class="fa fa-object-group"></i> <span>Quản lý Chính sách</span>
        </a>
      </li>
    </ul>
    <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'tutorials' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.tutorial.index") }}"><i class="fa fa-ioxhost"></i> <span>Phương thức thanh toán</span>
        </a>
      </li>
    </ul>
    <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'criterias' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.criteria.index") }}"><i class="fa fa-ioxhost"></i> <span>Quản lý Tiêu chí</span>
        </a>
      </li>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'productcategories' || $segment2 == 'procatones' || $segment2 == 'procattwos' || $segment2 == 'procatthrees' || $segment2 == 'products' ? 'menu-open active' : '' }}">
        <a href="#"><i class="fa fa-rocket"></i> <span>Sản phẩm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="{{ $segment2 == 'productcategories' || $segment2 == 'products' ? 'display:block' : '' }}">
          {{-- <li {{ $segment2 == 'productcategories' ? 'class=active' : '' }}><a href="{{ route("backend.productcategory.index") }}"><i class="fa fa-angle-right"></i>Danh mục Sản phẩm</a></li> --}}
          <li {{ $segment2 == 'procatones' ? 'class=active' : '' }}><a href="{{ route("backend.procatone.index") }}"><i class="fa fa-angle-right"></i>Danh mục Cấp 1</a></li>
          <li {{ $segment2 == 'procattwos' ? 'class=active' : '' }}><a href="{{ route("backend.procattwo.index") }}"><i class="fa fa-angle-right"></i>Danh mục Cấp 2</a></li>
          {{-- <li {{ $segment2 == 'procatthrees' ? 'class=active' : '' }}><a href="{{ route("backend.procatthree.index") }}"><i class="fa fa-angle-right"></i>Danh mục Cấp 3</a></li> --}}
          <li {{ $segment2 == 'products' ? 'class=active' : '' }}><a href="{{ route("backend.product.index") }}"><i class="fa fa-angle-right"></i>Quản lý Sản phẩm</a></li>
        </ul>
      </li>
    </ul>
    <ul class="sidebar-menu" data-widget="tree">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'posts' || $segment2 == 'newcategories' ? 'menu-open active' : '' }}">
        <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tin tức</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="{{ $segment2 == 'posts' || $segment2 == 'newcategories' ? 'display:block' : '' }}">
          <li {{ $segment2 == 'newcategories' ? 'class=active' : '' }}><a href="{{ route("backend.newcategory.index") }}"><i class="fa fa-angle-right"></i>Danh mục Tin tức</a></li>
          <li {{ $segment2 == 'posts' ? 'class=active' : '' }}><a href="{{ route("backend.post.index") }}"><i class="fa fa-angle-right"></i>Quản lý Tin tức</a></li>
        </ul>
      </li>
    </ul>
    <ul class="sidebar-menu">
      <li class="treeview {{ $segment2 == 'servis' ? 'menu-open active' : '' }}">
        <a href="{{ route('backend.servi.index') }}"><i class="fa fa-newspaper-o"></i> <span>Dịch vụ</span>
        </a>
      </li>
    </ul>
    {{-- <ul class="sidebar-menu">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'customers' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.customer.index") }}"><i class="fa fa-users"></i> <span>Ý kiến Khách hàng</span>
        </a>
      </li>
    </ul> --}}
    {{-- <ul class="sidebar-menu">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'whys' ? 'menu-open active' : '' }}">
        <a href="{{ route("backend.why.index") }}"><i class="fa fa-question-circle"></i> <span>Vì sao chọn ?</span>
        </a>
      </li>
    </ul> --}}
    <ul class="sidebar-menu" data-widget="tree">
      @php
      $tags       = Tag::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'slider' || $segment2 == 'social' || $segment2 == 'other' ? 'menu-open active' : '' }}">
        <a href="#"><i class="fa fa-image"></i> <span>Hình ảnh</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="{{ $segment2 == 'slider' || $segment2 == 'social' || $segment2 == 'other' ? 'display:block' : '' }}">
          <li {{ $segment2 == 'slider' ? 'class=active' : '' }}><a href="{{ route("backend.slider.index") }}"><i class="fa fa-angle-right"></i>Quản lý Sliders</a></li>
          <li {{ $segment2 == 'social' ? 'class=active' : '' }}><a href="{{ route("backend.social.index") }}"><i class="fa fa-angle-right"></i>Liên kết Social</a></li>
          <li {{ $segment2 == 'other' ? 'class=active' : '' }}><a href="{{ route("backend.other.index") }}"><i class="fa fa-angle-right"></i>Đối tác</a></li>
        </ul>
      </li>
    </ul>
    <ul class="sidebar-menu">
      @php
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      @endphp
      <li class="treeview {{ $segment2 == 'videos' ? 'menu-open active' : '' }}">
        <a href="{{ route("video.index") }}"><i class="fa  fa-youtube-play"></i> <span>Videos</span>
        </a>
      </li>
    </ul>
    <ul class="sidebar-menu">
      @php
      $settings   = Setting::count();
      $segment2   = Request::segment(2);
      $segment3   = Request::segment(3);
      $segment4   = Request::segment(4);
      @endphp
      <li class="treeview {{ $segment2 == 'settings' ? 'menu-open active' : '' }}">
        <a href="{{ route('frontend.home.index') }}/administrator/settings/edit"><i class="fa fa-gears"></i> <span>Cấu hình Website</span>
        </a>
      </ul>
      {{-- <ul class="sidebar-menu">
        @php
        $segment2   = Request::segment(2);
        @endphp
        <li class="treeview {{ $segment2 == 'users' || $segment2 == 'roles' ? 'menu-open active' : '' }}">
          <a href="{{ route("backend.user.index") }}"><i class="fa fa-user-secret"></i> <span>Quản trị viên</span>
          </a>
        </li>
      </ul> --}}
    </section>
  </aside>