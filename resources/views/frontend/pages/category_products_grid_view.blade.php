
@extends('frontend.layouts.master')

@section('main_content')

    <main>
        <div class="top_banner">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{!! route('frontend.home') !!}">Home</a></li>

                            @if($category->parent_id != 0)
                                <li>
                                    <a href="{!! route('frontend.category-products', ['category_slug' => $category->parent->slug]) !!}">
                                        {!! $category->parent->title !!}
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! route('frontend.category-products', ['category_slug' => $category->parent->slug, 'sub_category_slug' => $category->slug]) !!}">
                                        {!! $category->title !!}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{!! route('frontend.category-products', ['category_slug' => $category->slug]) !!}">
                                        {!! $category->title !!}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <h1>

                        @if($category->parent_id != 0)
                            {!! $category->parent->title !!} - {!! $category->title !!}
                        @else
                            {!! $category->title !!}
                        @endif
                    </h1>
                </div>
            </div>
            <img src="/assets/frontend/img/bg_cat_shoes.jpg" class="img-fluid" alt="">
        </div>
        <!-- /top_banner -->

        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <div class="sort_select">
                            <select name="sort" id="sort">
                                <option value="popularity" selected="selected">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to
                            </select>
                        </div>
                    </li>
                    {{--<li>
                        <a href="#0"><i class="ti-view-grid"></i></a>
                        <a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
                    </li>--}}
                    <li>
                        <a data-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
                            <i class="ti-filter"></i><span>Filters</span>
                        </a>
                    </li>
                </ul>
                <div class="collapse" id="filters"><div class="row small-gutters filters_listing_1">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="drop">Categories</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Men <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Women <small>24</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Running <small>23</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Training <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Apply</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="drop">Color</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Blue <small>06</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Red <small>12</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Orange <small>17</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Black <small>43</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Apply</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="drop">Brand</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">Adidas <small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Nike <small>08</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Vans <small>05</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">Puma <small>18</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Apply</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="drop">Price</a>
                            <div class="dropdown-menu">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label class="container_check">$0 ??? $50<small>11</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">$50 ??? $100<small>08</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">$100 ??? $150<small>05</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="container_check">$150 ??? $200<small>18</small>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a href="#0" class="apply_filter">Apply</a>
                                </div>
                            </div>
                        </div>
                        <!-- /dropdown -->

                    </div></div></div>
            </div>
        </div>
        <!-- /toolbox -->

        <div class="container margin_30">
            <div class="row small-gutters">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <span class="ribbon new">New</span>
                                    <a href="{!! route('frontend.product-details', ['category' => $product->category->slug, 'slug' => $product->slug]) !!}">
                                        <img class="img-fluid lazy" src="img/products/product_placeholder_square_medium.jpg" data-src="{!! asset($product->mainImage->image) !!}" alt="">
                                    </a>
                                    {{--<div data-countdown="2022/05/15" class="countdown"></div>--}}
                                </figure>
                                <a href="{!! route('frontend.product-details', ['category' => $product->category->slug, 'slug' => $product->slug]) !!}">
                                    <h3>{!! $product->title !!}</h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price"><span class="currency">???</span>{!! $product->sell_price !!}</span>
                                    @if($product->product_price != $product->sell_price)
                                        <span class="old_price"><span class="currency">???</span>{!! $product->product_price !!}</span>
                                    @endif
                                </div>
                                <ul>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                    <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <h3 class="text-center">
                            Empty Products!!
                        </h3>
                    </div>
                @endif
                <!-- /col -->
            </div>
            <!-- /row -->

           {{-- <div class="pagination__wrapper">
                <ul class="pagination">
                    <li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
                    <li>
                        <a href="#0" class="active">1</a>
                    </li>
                    <li>
                        <a href="#0">2</a>
                    </li>
                    <li>
                        <a href="#0">3</a>
                    </li>
                    <li>
                        <a href="#0">4</a>
                    </li>
                    <li><a href="#0" class="next" title="next page">&#10095;</a></li>
                </ul>
            </div>--}}

        </div>
        <!-- /container -->
    </main>
    <!-- /main -->
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/listing.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/sticky_sidebar.min.js') !!}"></script>
    <script src="{!! asset('assets/frontend/js/specific_listing.js') !!}"></script>
@endsection