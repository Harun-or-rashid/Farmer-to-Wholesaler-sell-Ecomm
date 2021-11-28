
@foreach($childs as $child)
    <option value="{{ $child->id }}" {!! (old('parent_id') == $child->id)?'selected':'' !!}>
        @for($j = 0; $j < $i; $j++)
            -
        @endfor{!! $child->title !!}
    </option>
    @if(count($child->childs))
        @php($i++)
        @include('backend.product_category.__category_child_list_in_select',['childs' => $child->childs])
    @endif

@endforeach
