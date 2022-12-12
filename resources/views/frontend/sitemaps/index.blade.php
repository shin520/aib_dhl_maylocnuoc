@php print '<?xml version="1.0" encoding="UTF-8" ?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc>{{ route('frontend.home.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ $setting->title }}</image:title>
      <image:caption>{{ $setting->title }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.about.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($abouts->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $abouts->img }}</image:loc>
      <image:title>{{ $abouts->title }}</image:title>
      <image:caption>{{ $abouts->title }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.cat') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ 'Tất cả sản phẩm' }}</image:title>
      <image:caption>{{ 'Tất cả sản phẩm' }}</image:caption>
    </image:image>
  </url>
  @foreach ($all_products_index as $product)
    <url>
      <loc>{{ route('frontend.home.index') }}/{{ $product->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($product->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $product->img }}</image:loc>
        <image:title>{{ $product->title }}</image:title>
        <image:caption>{{ $product->title }}</image:caption>
      </image:image>
    </url>
  @endforeach
  @foreach ($procatones as $k => $procatone)
    <url>
      <loc>{{ route('frontend.home.index') }}/san-pham/{{ $procatone->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($procatone->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $procatone->img }}</image:loc>
        <image:title>{{ $procatone->title }}</image:title>
        <image:caption>{{ $procatone->title }}</image:caption>
      </image:image>
    </url>
    @php
      $procattwos = Procattwo::where('procatone_id',$procatone->id)->where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    @endphp
    @if($procattwos->isNotEmpty())
    @foreach($procattwos as $procattwo)
    <url>
      <loc>{{ route('frontend.home.index') }}/san-pham/{{ $procattwo->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($procattwo->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $procattwo->img }}</image:loc>
        <image:title>{{ $procattwo->title }}</image:title>
        <image:caption>{{ $procattwo->title }}</image:caption>
      </image:image>
    </url>
    @endforeach
    @endif
  @endforeach
  @foreach ($newcategories as $k => $newcategory)
    <url>
      <loc>{{ route('frontend.home.index') }}/tin-tuc/{{ $newcategory->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($newcategory->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $newcategory->img }}</image:loc>
        <image:title>{{ $newcategory->title }}</image:title>
        <image:caption>{{ $newcategory->title }}</image:caption>
      </image:image>
    </url>
  @endforeach
  @foreach ($posts as $post)
    <url>
      <loc>{{ route('frontend.home.index') }}/{{ $post->slug.'.htmI' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($post->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $post->img }}</image:loc>
        <image:title>{{ $post->title }}</image:title>
        <image:caption>{{ $post->title }}</image:caption>
      </image:image>
    </url>
  @endforeach
  @foreach ($policies as $policy)
    <url>
      <loc>{{ route('frontend.home.index') }}/chinh-sach/{{ $policy->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($policy->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $policy->img }}</image:loc>
        <image:title>{{ $policy->title }}</image:title>
        <image:caption>{{ $policy->title }}</image:caption>
      </image:image>
    </url>
  @endforeach
  @foreach ($tutorials as $tutorial)
    <url>
      <loc>{{ route('frontend.home.index') }}/huong-dan/{{ $tutorial->slug.'.html' }}</loc>
      <lastmod>{{ date("Y-m-d", strtotime($tutorial->updated_at)) }}</lastmod>
      <image:image>
        <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $tutorial->img }}</image:loc>
        <image:title>{{ $tutorial->title }}</image:title>
        <image:caption>{{ $tutorial->title }}</image:caption>
      </image:image>
    </url>
  @endforeach
  <url>
    <loc>{{ route('frontend.price.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($setting->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $setting->img }}</image:loc>
      <image:title>{{ 'Đăng ký nhận báo giá' }}</image:title>
      <image:caption>{{ 'Đăng ký nhận báo giá' }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.contact.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($contacts->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $contacts->img }}</image:loc>
      <image:title>{{ $contacts->title }}</image:title>
      <image:caption>{{ $contacts->title }}</image:caption>
    </image:image>
  </url>
  <url>
    <loc>{{ route('frontend.author.index') }}</loc>
    <lastmod>{{ date("Y-m-d", strtotime($author->updated_at)) }}</lastmod>
    <image:image>
      <image:loc>{{ route('frontend.home.index') }}/storage/uploads/{{ $author->img }}</image:loc>
      <image:title>{{ $author->title }}</image:title>
      <image:caption>{{ $author->title }}</image:caption>
    </image:image>
  </url>
</urlset>