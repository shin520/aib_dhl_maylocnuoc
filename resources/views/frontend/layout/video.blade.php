<div class="service-basic-wrap website-wrap-bg" style="border-top: 2px solid #fd4205;padding-top: 0px;">
  {{-- @include("frontend.layout.product") --}}
<div class="main-title-box mx-auto menu-color title-index-why" style="top:-24px"><h2 style="display: inline;font-size:18px">VIDEOS</h2></div>
<div class="container">
	{{-- <div class="mx-auto font-weight-bold">
	  <div class="main-title">
	    <h2 class="text-center mb-4">VIDEOS</h2>
	  </div>
	</div> --}}

	<div class="swiper-container-videos" style="overflow: hidden;">
	  <div class="swiper-wrapper wow fadeInUp" style="background:none; visibility: visible; animation-name: fadeInUp;">
	    @foreach($videos as $video)
	      <div class="swiper-slide" style="background:none;">
	        <figure class="clearfix">
	        
	             	<div class="plyr__video-embed">
	             		<iframe
	             		src="{{ $video->link }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
	             		allowfullscreen
	             		allowtransparency
	             		allow="autoplay"
	             		>
	             		</iframe>
	             	</div>
	             	<div class="title-madamsaigon">
	             		<h3 class="text-center mt-3 mb-5" style="color: #9B4002">{{ $video->name }}</h3>
	             	</div>
	        </figure>
	      </div>
	    @endforeach
	  </div>
	</div>


	{{-- <div class="row">
		@foreach($videos as $video)
		<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-5">
			<div class="plyr__video-embed">
				<iframe
				src="{{ $video->link }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
				allowfullscreen
				allowtransparency
				allow="autoplay"
				>
				</iframe>
			</div>
			<h3 class="text-center mt-3" style="color: #444">{{ $video->name }}</h3>
		</div>
		@endforeach
		<nav class="mb-5" style="margin: 0 auto;">
		  <ul class="pagination justify-content-center mb-4">
		    {{ $videos->links('vendor.pagination.bootstrap-4') }}
		  </ul>
		</nav>
	</div> --}}
</div>
</div>