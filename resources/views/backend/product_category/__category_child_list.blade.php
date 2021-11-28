<ul>

    @foreach($childs as $child)

        <li>

            {{ $child->title }}
            <span class="menu_edit_class">
                <a href="{!! route('backend.admin.product.category.edit', $child->id) !!}">Edit</a>
            </span>

            @if(count($child->childs))

                @include('backend.product_category.__category_child_list',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>