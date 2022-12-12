@extends("frontend.layout.master-layout")
@section("content")
<section class="bread-crumb margin-bottom-10">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
          <li class="home">
            <a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
            <span><i class="fa fa-angle-right"></i></span>
          </li>
          <li><strong itemprop="title">Liên hệ</strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="container contact">
  <div class="row">
    <div class="col-md-4">
      <div class="widget-item info-contact in-fo-page-content">
        <h1 class="title-head">Thông tin liên hệ</h1>
        <ul class="widget-menu contact-info-page">
          <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $setting->address }}</li>
          <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{ $setting->href_1 }}">{{ $setting->hotline_1 }}</a></li>
          <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{ $setting->href_2 }}">{{ $setting->hotline_2 }}</a></li>
          <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
        </ul>
      </div>
      <div class="box-maps margin-top-10 margin-bottom-10">
        {!! $setting->maps !!}
      </div>
    </div>
    <div class="col-md-8">
      <div class="page-login">
        <div id="login">
          <h3 class="title-head text-center">Gửi thông tin</h3>
          <span class="text-center block"></span>
          <span class="text-center margin-bottom-10 block">Bạn hãy điền nội dung tin nhắn vào form dưới đây và gửi cho chúng tôi. Chúng tôi sẽ trả lời bạn sau khi nhận được.</span>
          <form accept-charset="utf-8" action="{{ route('backend.contactform.store') }}" id="contact" method="POST">
            @csrf
            <input type="hidden" name="recaptcha" id="recaptcha">
            @if (Session::has('success'))
            <div class="alert-custom">
              <div class="alert alert-success alert-dismissible fade in" role="alert">{{ Session::get('success') }}</div>
            </div>
            @endif
            <input type="hidden" id="type" name="type" value="contactform">
            <input type="hidden" id="read" name="read" value="1">
            <input type="hidden" class="form-control" name="stt" id="stt" value="1" placeholder="stt"/>
            <div class="form-signup clearfix">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <fieldset class="form-group">
                    <label>Họ tên<span class="required">*</span></label>
                    <input type="text" name="name" id="name" class="form-control  form-control-lg" data-validation-error-msg= "Không được để trống" data-validation="required" required />
                  </fieldset>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <fieldset class="form-group">
                    <label>Email<span class="required">*</span></label>
                    <input type="email" name="email" data-validation="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation-error-msg= "Email sai định dạng" id="email" class="form-control form-control-lg" required />
                  </fieldset>
                </div>
                <div class="col-sm-12 col-xs-12">
                  <fieldset class="form-group">
                    <label>Điện thoại<span class="required">*</span></label>
                    <input type="tel" name="phone" data-validation="tel" data-validation-error-msg= "Không được để trống" id="tel" class="number-sidebar form-control form-control-lg" required />
                  </fieldset>
                </div>
                <div class="col-sm-12 col-xs-12">
                  <fieldset class="form-group">
                    <label>Nội dung<span class="required">*</span></label>
                    <textarea name="contactcontent" id="contactcontent" class="form-control form-control-lg" rows="5" data-validation-error-msg= "Không được để trống" data-validation="required" required></textarea>
                  </fieldset>
                  <div class="pull-xs-left" style="margin-top:20px;">
                    <button type="submit" class="btn btn-blues btn-style btn-style-active">Gửi tin nhắn</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .box-maps{height: 350px;overflow: hidden;}
  footer.footer-other{margin-top:0;}
  .search-more{margin-top:0;}
</style>
@endsection

@push("style")
@endpush

@push("script")
<script type='application/ld+json'>{"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"{{ route('frontend.home.index') }}#organization","name":"{{ $contacts->name }}","url":"{{ route('frontend.home.index') }}","sameAs":["{{ $setting->facebook }}","{{ $setting->twitter }}","{{ $setting->youtube }}"],"logo":{"@type":"ImageObject","@id":"{{ route('frontend.home.index') }}#logo","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80,"caption":"{{ $setting->nameindex }}"},"image":{"@id":"{{ route('frontend.home.index') }}#logo"},"legalName":"{{ $setting->nameindex }}"},{"@type":"WebSite","@id":"{{ route('frontend.home.index') }}#website","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}","description":"{{ $setting->description }}","publisher":{"@id":"{{ route('frontend.home.index') }}#organization"}},{"@type":"ImageObject","@id":"{{ route('frontend.contact.index') }}#primaryimage","url":"{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->logoindex }}","width":150,"height":80},{"@type":["WebPage","ContactPage"],"@id":"{{ route('frontend.contact.index') }}#webpage","url":"{{ route('frontend.contact.index') }}","inLanguage":"{{ $setting->lang }}","name":"{{ $contacts->name }}","isPartOf":{"@id":"{{ route('frontend.home.index') }}#website"},"primaryImageOfPage":{"@id":"{{ route('frontend.contact.index') }}#primaryimage"},"datePublished":"{{ $contacts->created_at }}","dateModified":"{{ $contacts->updated_at }}","description":"{{ $contacts->descriptions }}","breadcrumb":{"@id":"{{ route('frontend.contact.index') }}#breadcrumb"}},{"@type":"BreadcrumbList","@id":"{{ route('frontend.contact.index') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"item":{"@type":"WebPage","@id":"{{ route('frontend.home.index') }}","url":"{{ route('frontend.home.index') }}","name":"{{ $setting->nameindex }}"}},{"@type":"ListItem","position":2,"item":{"@type":"WebPage","@id":"{{ route('frontend.contact.index') }}","url":"{{ route('frontend.contact.index') }}","name":"{{ $contacts->name }}"}}]}]}</script>
@endpush