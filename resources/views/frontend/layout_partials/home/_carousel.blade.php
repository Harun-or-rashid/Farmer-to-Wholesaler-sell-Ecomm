<div id="carousel-home">
    <div class="owl-carousel owl-theme">
        @if(!empty($slider_products))
            @foreach($slider_products as $slider_product)
                <div class="owl-slide cover" style="background-image: url({!! asset($slider_product->mainImage->image) !!});">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-right white">
                                        <h2 class="owl-slide-animated owl-slide-title">{{ $slider_product->title }}<br>{{ $slider_product->category->title }}</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            <span class="currency">৳</span>{{ $slider_product->sell_price }}
                                        </p>
                                        <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{!! route('frontend.product-details', ['category' => $slider_product->category->slug, 'slug' => $slider_product->slug]) !!}" role="button">Shop Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
            @endforeach
        @endif
    </div>
    <div id="icon_drag_mobile"></div>
</div>