<section class="awe-section-1">
    <div class="home-slider owl-carousel not-dqowl">
        @foreach ($sliders as $k => $slider)
        @if($slider->type == 'slider')
        <div class="item">
            <a href="{{ $slider->url }}" class=" justify-content-center d-flex"><img src="/storage/uploads/{{ $slider->img }}" alt="{{ $slider->title }}" title="{{ $slider->title }}" class="img-responsive center-block" /></a>
        </div>
        @endif
        @endforeach
    </div>
</section>