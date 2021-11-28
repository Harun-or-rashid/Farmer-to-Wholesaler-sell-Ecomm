<ul>
    @if(!empty($cartContents))
        @foreach($cartContents as $cartContent)
            <li>
                <a href="{!! route('frontend.product-details', ['category' => $cartContent->options->category_slug, 'slug' => $cartContent->options->product_slug]) !!}">
                    <figure><img src="{!! asset($cartContent->options->image) !!}" data-src="{!! asset($cartContent->options->image) !!}" alt="" width="50" height="50" class="lazy"></figure>
                    <strong>
                        <span>{!! $cartContent->qty !!} x {!! $cartContent->name !!}</span>
                        <span class="currency">৳{!! $cartContent->price !!}</span>
                        <span >Color: {!! $cartContent->options->color !!}</span>
                    </strong>
                </a>
                <a href="javascript:void(0)" onclick="removeTopCartContent('{!! $cartContent->rowId !!}')" class="action"><i class="ti-trash"></i></a>
            </li>
        @endforeach
    @endif
</ul>
<div class="total_drop">
    <div class="clearfix">
        <strong>Total</strong>
        <span>{!! $totalPrice !!}</span>
        <span class="currency">৳</span>
    </div>
    <a href="{{route('frontend.viewcart')}}" class="btn_1 outline">View Cart</a>
    <a href="{{ route('frontend.checkout') }}" class="btn_1">Checkout</a>
</div>
