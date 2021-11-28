
@foreach($childs as $child)
    @php($i++)

    @if(!in_array($child->id, $edit_category_childs))
        <option value="{{ $child->id }}" {!! ($edit_category->parent_id == $child->id)?'selected':'' !!}>
            @for($j = 0; $j<$i; $j++)
                -
            @endfor{!! $child->title !!}
        </option>
    @endif
    @if(count($child->childs))
        @include('backend.product_category.__edit_category_child_list_in_select',['childs' => $child->childs])
    @endif

@endforeach
