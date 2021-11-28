
@if(count($sub_categories) > 0)
    <option value="">--Select--</option>
    @foreach($sub_categories as $category)
        <option value="{!! $category->id !!}">{!! $category->title !!}</option>
    @endforeach
@else
    <option value="">No-Category-Available</option>
@endif