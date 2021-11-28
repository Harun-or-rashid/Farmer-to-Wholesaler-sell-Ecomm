<ul id="banners_grid" class="clearfix">
    @if(!empty($featured_categories))
        @foreach($featured_categories as $featured_category)
            <li>
                <a href="{!! route('frontend.category-products', ['category_slug' => $featured_category->slug]) !!}" class="img_container">
                    @if($featured_category->image != '')
                        <img src="{!! asset($featured_category->image) !!}" data-src="{!! asset($featured_category->image) !!}" alt="" class="lazy">
                    @else
                        <img src="{!! asset('assets/frontend/img/') !!}/banner_1.jpg" data-src="{!! asset('assets/frontend/img/') !!}/banner_1.jpg" alt="" class="lazy">
                    @endif

                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>{!! $featured_category->title !!}</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
        @endforeach
    @endif
</ul>