        <div class="mb-5">
        <div class="swiper-container slider">
            <div class="swiper-wrapper">
                @foreach ($sliders as $k => $slider)
                @if($slider->type == 'slider')
                <div class="swiper-slide">
                    <a href="{{ $slider->url }}" title="{{ $slider->title }}" rel="follow"><img src="/storage/uploads/{{ $slider->img }}" alt="{{ $slider->title }}" title="{{ $slider->title }}"></a>
                </div>
                @endif
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-slider"></div>
            <!-- Add Pagination -->
            <div class="swiper-button-next swiper-button-next-slider"></div>
            <div class="swiper-button-prev swiper-button-prev-slider"></div>
        </div>
        </div>