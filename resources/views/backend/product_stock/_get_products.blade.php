
@if(count($products) > 0)
    <option value="">--Select Product--</option>
    @foreach($products as $product)
        <option value="{!! $product->id !!}">{!! $product->title !!}</option>
    @endforeach
@else
    <option value="">No-Product-Available</option>
@endif