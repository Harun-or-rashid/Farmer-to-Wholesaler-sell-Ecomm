<div class="featured lazy" data-bg="url({!! asset('assets/frontend/img/') !!}/featured_home.jpg)">
    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container margin_60">
            <div class="row justify-content-center justify-content-md-start">
                <div class="col-lg-6 wow" data-wow-offset="150">
                    <h3>Armor<br>Air Color 720</h3>
                    <p>Lightweight cushioning and durable support with a Phylon midsole</p>
                    <div class="feat_text_block">
                        <div class="price_box">
                            <span class="new_price">$90.00</span>
                            <span class="old_price">$170.00</span>
                        </div>
                        <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container margin_60_35">
    <div class="main_title">
        <h2>Featured</h2>
        <span>Products</span>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
    </div>
    <div class="owl-carousel owl-theme products_carousel">
        @if(!empty($featured_products))
            @foreach($featured_products as $featured_product)
                <div class="item">
                    <div class="grid_item">
                        @if($featured_product->product_price != $featured_product->sell_price)
                            <span class="ribbon off">-{!! $featured_product->discount_percent !!}%</span>
                        @else
                            <span class="ribbon new">New</span>
                        @endif
                        <figure>
                            <a href="{!! route('frontend.product-details', ['category' => $featured_product->category->slug, 'slug' => $featured_product->slug]) !!}">
                                <img class="owl-lazy" src="{!! asset('assets/frontend/img/') !!}/products/product_placeholder_square_medium.jpg" data-src="{!! asset('assets/frontend/img/') !!}/products/shoes/4.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating">
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star"></i>
                        </div>
                        <a href="{!! route('frontend.product-details', ['category' => $featured_product->category->slug, 'slug' => $featured_product->slug]) !!}">
                            <h3>{!! $featured_product->title !!}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price"><span class="currency">৳</span>{!! $featured_product->sell_price !!}</span>
                            @if($featured_product->product_price != $featured_product->sell_price)
                                <span class="old_price"><span class="currency">৳</span>{!! $featured_product->product_price !!}</span>
                            @endif
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
            @endforeach
        @endif
    </div>
    <!-- /products_carousel -->
</div>