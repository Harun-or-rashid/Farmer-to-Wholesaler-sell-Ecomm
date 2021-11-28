<div class="container margin_60_35">
    <div class="main_title">
        <h2>Top Selling</h2>
        <span>Products</span>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
    </div>
    <div class="row small-gutters">
        @if(!empty($top_selling_products))
            @foreach($top_selling_products as $top_selling_product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>
                            @if($top_selling_product->product_price != $top_selling_product->sell_price)
                                <span class="ribbon off">-{!! $top_selling_product->discount_percent !!}%</span>
                            @else
                                <span class="ribbon hot">Hot</span>
                            @endif
                            <a href="{!! route('frontend.product-details', ['category' => $top_selling_product->category->slug, 'slug' => $top_selling_product->slug]) !!}">
                                <img class="img-fluid lazy" src="{!! asset('assets/frontend/img/') !!}/products/product_placeholder_square_medium.jpg" data-src="{!! asset('assets/frontend/img/') !!}/products/shoes/2.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating">
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star"></i>
                        </div>
                        <a href="{!! route('frontend.product-details', ['category' => $top_selling_product->category->slug, 'slug' => $top_selling_product->slug]) !!}">
                            <h3>{!! $top_selling_product->title !!}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price"><span class="currency">৳</span>{!! $top_selling_product->sell_price !!}</span>
                            @if($top_selling_product->product_price != $top_selling_product->sell_price)
                                <span class="old_price"><span class="currency">৳</span>{!! $top_selling_product->product_price !!}</span>
                            @endif
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /col -->
            @endforeach
        @endif
    </div>
    <!-- /row -->
</div>