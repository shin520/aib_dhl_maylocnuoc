<body>    
<header class="header"> 
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <ul class="top-left-info">
            @foreach($sliders as $slider)
            @if($slider->type == 'social')
            <li><a target="_blank" rel="nofollow" href="{{ $slider->url }}">{!! $slider->icon !!}</li>
            @endif
            @endforeach
          </ul>
        </div>
        <ul class="top-right-info d-xs-none">
          <li>
            <a href="/lien-he.html"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $setting->address }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="header-main">
      <div class="row">
        <div class="col-md-3 col-100-h">
          <button type="button" class="navbar-toggle collapsed d-sm-none d-xs-none" id="trigger-mobile">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="logo">
            <a href="/" class="logo-wrapper">          
              <img src="/storage/uploads/{{ $setting->logoindex }}" title="{{ $setting->nameindex }}" alt="logo {{ $setting->nameindex }}">         
            </a>          
          </div>
          <div class="mobile-cart d-sm-none d-xs-none">
            <a href="{{ route('order.view') }}" title="Giỏ hàng">
              <i class="fa fa-shopping-bag"></i>
              <div class="cart-right">
                <span class="count_item_pr">{{ $order->total_quantity }}</span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-5">
          <div class="search">
            <div class="header_search search_form">
  <form class="input-group search-bar search_form" action="{{ route('search.index') }}" method="get" role="search">   
    <input type="search" name="search" value="" placeholder="Tìm kiếm sản phẩm... " class="input-group-field st-default-search-input search-text" autocomplete="off" required="">
    <span class="input-group-btn">
      <button class="btn icon-fallback-text">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </form>
  
  {{-- <div id='search_suggestion'>
  <div id='search_top'>
    <div id="product_results"></div>
    <div id="article_results"></div>
  </div>
  <div id='search_bottom'>
    <a class='show_more' href='#'>Hiển thị tất cả kết quả cho "<span></span>"</a>
  </div>
</div> --}}
{{-- <script>
  $(document).ready(function ($) {
              var settings = {
                searchArticle: "0",
                articleLimit: 5,
                productLimit: 5,
                showDescription: "0"
              };
              var suggestionWrap = document.getElementById('search_suggestion');
              var searchTop = document.getElementById('search_top');
              var productResults = document.getElementById('product_results');
              var articleResults = document.getElementById('article_results');
              var searchBottom = document.getElementById('search_bottom');
              var isArray = function(a) {
                return Object.prototype.toString.call(a) === "[object Array]";
              }
              var createEle = function(desc) {
                if (!isArray(desc)) {
                  return createEle.call(this, Array.prototype.slice.call(arguments));
                }
                var tag = desc[0];
                var attributes = desc[1];
                var el = document.createElement(tag);
                var start = 1;
                if (typeof attributes === "object" && attributes !== null && !isArray(attributes)) {
                  for (var attr in attributes) {
                    el[attr] = attributes[attr];
                  }
                  start = 2;
                }
                for (var i = start; i < desc.length; i++) {
                  if (isArray(desc[i])) {
                    el.appendChild(createEle(desc[i]));
                  }
                  else {
                    el.appendChild(document.createTextNode(desc[i]));
                  }
                }
                return el;
              }
              var loadResult = function(data, type) {
                if(type==='product')
                {
                  productResults.innerHTML = '';
                }
                if(type==='article')
                {
                  articleResults.innerHTML = '';
                }
                var articleLimit = parseInt(settings.articleLimit);
                var productLimit = parseInt(settings.productLimit);
                var showDescription = settings.showDescription;
                if(data.indexOf('<iframe') > -1) {
                  data = data.substr(0, (data.indexOf('<iframe') - 1))
                }
                var dataJson = JSON.parse(data);
                if(dataJson.results !== undefined)
                {
                  var resultList = [];
                  searchTop.style.display = 'block';
                  if(type === 'product') {
                    productResults.innerHTML = ''
                    productLimit = Math.min(dataJson.results.length, productLimit);
                    for(var i = 0; i < productLimit; i++) {
                      resultList[i] = dataJson.results[i];
                    }
                  }
                  else {
                    articleResults.innerHTML = '';
                    articleLimit = Math.min(dataJson.results.length, articleLimit);
                    for(var i = 0; i < articleLimit; i++) {
                      resultList[i] = dataJson.results[i];
                    }
                  }
                  var searchTitle = 'Sản phẩm gợi ý'
                  if(type === 'article') {
                    searchTitle = 'Bài viết';
                  }
                  var searchHeading = createEle(['h3', searchTitle]);
                  var searchList = document.createElement('ul');
                  for(var index = 0; index < resultList.length; index++) {
                    var item = resultList[index];
                    var priceDiv = '';
                    var descriptionDiv = '';
                    if(type == 'product') {
                      if(item.price_contact) {
                        priceDiv = ['div', {className: 'item_price'},
                              ['ins', item.price_contact]
                               ];
                      }
                      else {
                        if(item.price_from) {
                          priceDiv = ['div', {className: 'item_price'},
                                ['span', 'Từ '],
                                ['ins', item.price_from]
                                 ];
                        }
                        else {
                          priceDiv = ['div', {className: 'item_price'},
                                ['ins', parseFloat(item.price)  ? item.price : 'Liên hệ']
                                 ];
                        }
                      }
                      if(item.compare_at_price !== undefined) {
                        priceDiv.push(['del', item.compare_at_price]);
                      }
                    }
                    if(showDescription == '1') {
                      descriptionDiv = ['div', {className: 'item_description'}, item.description]
                    }
                    var searchItem = createEle(
                      ['li',
                       ['a', {href: item.url, title: item.title},
                        ['div', {className: 'item_image'},
                         ['img', {src: item.thumbnail, alt: item.title}]
                        ],
                        ['div', {className: 'item_detail'},
                         ['div', {className: 'item_title'},
                        ['h4', item.title]
                         ],
                         priceDiv, descriptionDiv
                        ]
                       ]
                      ]
                    )
                    searchList.appendChild(searchItem);
                  }
                  if(type === 'product') {
                    productResults.innerHTML = '';
                    productResults.appendChild(searchHeading);
                    productResults.appendChild(searchList);
                  }
                  else {
                    articleResults.innerHTML = '';
                    articleResults.appendChild(searchHeading);
                    articleResults.appendChild(searchList);
                  }
                }
                else
                {
                  if(type !== 'product' && false)
                  {
                    searchTop.style.display = 'none'
                  }
                }
              }
              var loadAjax = function(q) {
                if(settings.searchArticle === '1') {
                  loadArticle(q);
                }
                loadProduct(q);
              }
              var loadProduct = function(q) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if(this.readyState == 4 && this.status == 200) {
                    loadResult(this.responseText, 'product')
                  }
                }
                xhttp.open('GET', '/search?type=product&q=' + q + '&view=json', true);
                xhttp.send();
              }
              var loadArticle = function(q) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if(this.readyState == 4 && this.status == 200) {
                    loadResult(this.responseText, 'article')
                  }
                }
                xhttp.open('GET', '/search?type=article&q=' + q + '&view=json', true);
                xhttp.send();
              }
              var searchForm = document.querySelectorAll('form[action="/search"]');
              var getPos = function(el) {
                for (var lx=0, ly=0; el != null; lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
                return {x: lx,y: ly};
              }
              var initSuggestion = function(el) {

                var parentTop = el.offsetParent.offsetTop;
                var position = getPos(el);
                var searchInputHeight = el.offsetHeight;
                var searchInputWidth = el.offsetWidth;
                var searchInputX = position.x;
                var searchInputY = position.y;
                var suggestionPositionX = searchInputX;
                var suggestionPositionY = searchInputY + searchInputHeight;
                suggestionWrap.style.left = '0px';
                suggestionWrap.style.top = 52 + 'px';
                suggestionWrap.style.width = searchInputWidth + 'px';
              }
              window.__q__ = '';
              var loadAjax2 = function (q) {
                if(settings.searchArticle === '1') {
                }
                window.__q__ = q;
                return $.ajax({
                  url: '/search?type=product&q=' + q + '&view=json',
                  type:'GET'
                }).promise();
              };
              if(searchForm.length > 0) {
                for(var i = 0; i < searchForm.length; i++) {
                  var form = searchForm[i];
                  
                  var searchInput = form.querySelector('input');
                  
                  var keyup = Rx.Observable.fromEvent(searchInput, 'keyup')
                  .map(function (e) {
                    var __q = e.target.value;
                    initSuggestion(e.target);
                    if(__q === '' || __q === null) {
                      suggestionWrap.style.display = 'none';
                    }
                    else{
                      suggestionWrap.style.display = 'block';
                      var showMore = searchBottom.getElementsByClassName('show_more')[0];
                      showMore.setAttribute('href', '/search?q=' + __q);
                      showMore.querySelector('span').innerHTML = __q;
                    }
                    return e.target.value;
                  })
                  .filter(function (text) {
                    return text.length > 0;
                  })
                  .debounce(300  )
                  .distinctUntilChanged();
                  var searcher = keyup.flatMapLatest(loadAjax2);
                  searcher.subscribe(
                    function (data) {
                      loadResult(data, 'product');
                      if(settings.searchArticle === '1') {
                        loadArticle(window.__q__);
                      }
                    },
                    function (error) {

                    });
                }
              }
              window.addEventListener('click', function() {
                suggestionWrap.style.display = 'none';
              });
            });

</script> --}}
  
</div> 
          </div>
        </div>
        <div class="col-md-4 d-sm-block d-xs-none">
          <div class="header-right clearfix">
            <div class="top-cart-contain f-right">
              <div class="mini-cart text-xs-center">
                <div class="heading-cart cart_header">
                  <div class="icon_hotline">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                  </div>
                  <div class="content_cart_header">
                    <a class="bg_cart" href="{{ route('order.view') }}" title="Giỏ hàng">
                      (<span class="count_item count_item_pr">{{ $order->total_quantity }}</span>) Sản phẩm
                      <span class="text-giohang">Giỏ hàng</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="hotline_dathang f-right d-sm-block draw">
              <div class="icon_hotline">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </div>
              <div class="content_hotline">
                <a href="tel:{{ $setting->hotline_1 }}">{{ $setting->hotline_1 }}</a>
                <span>Tổng đài miễn phí</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="d-sm-block d-xs-none">
  <div class="container">
    <div class="col-md-3 no-padding">
      <div class="mainmenu ">
        <span><i class="ion ion-ios-keypad"></i> Danh mục sản phẩm</span>
        <div class="nav-cate">
          <ul id="menu2017">
            @foreach($pro_cats as $pro_cat)
            <li class="dropdown menu-item-count clearfix">
              <h3>
                <img src="//bizweb.dktcdn.net/100/368/036/themes/739045/assets/index-cate-icon-1.png?1593144236993" alt="KANGEN" />
                <a href="{{ route('frontend.home.index') }}/san-pham/{{ $pro_cat->slug.'.html' }}">{{ $pro_cat->name }}</a>
              </h3>
              @php
                  $sub_twos = Productcategory::where('parent_id',$pro_cat->id)->get();
              @endphp
              @if($sub_twos->isNotEmpty())
              @foreach($sub_twos as $two)
              <div class="subcate gd-menu">
                  <ul style="color: #000">
                    <li class="dropdown menu-item-count clearfix"><a href="{{ route('frontend.home.index') }}/san-pham/{{ $pro_cat->slug.'.html' }}">{{ $two->name }}</a></li>
                  </ul>
              </div>
              @endforeach
              @endif
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 no-padding">
      <ul id="nav" class="nav">
        <li class="nav-item active"><a class="nav-link" href="/">Trang chủ</a></li>
        <li class="nav-item "><a class="nav-link" href="{{ route('frontend.about.index') }}">Giới thiệu</a></li>
        <li class="nav-item  has-mega">
          <a href="{{ route('frontend.cat') }}" class="nav-link">Sản phẩm <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>     
          <div class="mega-content">
    <div class="level0-wrapper2">
       <div class="nav-block nav-block-center">
       <ul class="level0">
        @foreach($pro_cats as $pro_cat)
         <li class="level1 parent item"> <h2 class="h4"><a href="{{ route('frontend.home.index') }}/san-pham/{{ $pro_cat->slug.'.html' }}"><span>{{ $pro_cat->name }}</span></a></h2>
          @php
              $sub_twos = Productcategory::where('parent_id',$pro_cat->id)->get();
          @endphp
          @if($sub_twos->isNotEmpty())
          @foreach($sub_twos as $two)
           <ul class="level1">
             <li><a href="{{ route('frontend.home.index') }}/san-pham/{{ $pro_cat->slug.'.html' }}">{{ $two->name }}</a></li>
           </ul>
           @endforeach
           @endif
         </li>
       @endforeach
       </ul>
     </div>
   </div>
</div>  
        </li>

        <li class="nav-item "><a class="nav-link" href="/tin-tuc.html">Tin tức</a></li>
        <li class="nav-item "><a class="nav-link" href="/lien-he.html">Liên hệ</a></li>
      </ul> 
    </div>
  </div>
</nav>
{{-- <script>
  if ($(window).width() > 1100){
    
    
    var menu_limit = "8";
    if (isNaN(menu_limit)){
      menu_limit = 10;
    } else {
      menu_limit = 7;
    }
  }else{
    
    
    var menu_limit = "7";
    if (isNaN(menu_limit)){
      menu_limit = 8;
    } else {
      menu_limit = 6;
    }
  }
  var sidebar_length = $('.menu-item-count').length;
  if (sidebar_length > (menu_limit + 1) ){
    $('.nav-cate:not(.site-nav-mobile) > ul').each(function(){
      $('.menu-item-count',this).eq(menu_limit).nextAll().hide().addClass('toggleable');
      $(this).append('<li class="more"><h3><a><label>Xem thêm ... </label></a></h3></li>');
    });
    $('.nav-cate > ul').on('click','.more', function(){
      if($(this).hasClass('less')){
        $(this).html('<h3><a><label>Xem thêm ...</label></a></h3>').removeClass('less');
      } else {
        $(this).html('<h3><a><label>Thu gọn ... </label></a></h3>').addClass('less');;
      }
      $(this).siblings('li.toggleable').slideToggle({
        complete: function () {
          var divHeight = $('#menu2017').height() + 1; 
          $('.subcate.gd-menu').css('min-height', divHeight+'px');
          $('.subcate2').css('min-height', divHeight+'px');
        }
      });
    });
    $('.mainmenu-other').hover(function() {
      var divHeight = $('#menu2017').height() + 1; 
      $('.subcate.gd-menu').css('min-height', divHeight+'px');
      $('.subcate2').css('min-height', divHeight+'px');
    });
  }
</script> --}}
<style>
  .third-level-menu
  {
      position: absolute;
      top: 0;
      right: -150px;
      width: 150px;
      list-style: none;
      padding: 0;
      margin: 0;
      display: none;
  }

  .third-level-menu > li
  {
      height: 30px;
      background: #999999;
  }
  .third-level-menu > li:hover { background: #CCCCCC; }

  .second-level-menu
  {
      position: absolute;
      top: 30px;
      left: 0;
      width: 150px;
      list-style: none;
      padding: 0;
      margin: 0;
      display: none;
  }

  .second-level-menu > li
  {
      position: relative;
      height: 30px;
      background: #999999;
  }
  .second-level-menu > li:hover { background: #CCCCCC; }

  .top-level-menu
  {
      list-style: none;
      padding: 0;
      margin: 0;
  }

  .top-level-menu > li
  {
      position: relative;
      float: left;
      height: 30px;
      width: 150px;
      background: #999999;
  }
  .top-level-menu > li:hover { background: #CCCCCC; }

  .top-level-menu li:hover > ul
  {
      /* On hover, display the next level's menu */
      display: inline;
  }


  /* Menu Link Styles */

  .top-level-menu a /* Apply to all links inside the multi-level menu */
  {
      font: bold 14px Arial, Helvetica, sans-serif;
      color: #FFFFFF;
      text-decoration: none;
      padding: 0 0 0 10px;

      /* Make the link cover the entire list item-container */
      display: block;
      line-height: 30px;
  }
  .top-level-menu a:hover { color: #000000; }
</style>
</header>
    <h1 class="hidden">CÔNG TY TNHH AQUA FILTER - CÔNG TY TNHH AQUA FILTER - Máy lọc nước Kangen, Trim ion,... tạo ra nguồn nước nguyên thủy, trong lành với phân tử siêu nhỏ, có độ ion kiềm, khả năng chống oxy hoá cao, và giúp cơ thể chúng ta khôi phục lại trạng thái cân bằng, tinh khiết như trẻ sơ sinh..</h1>