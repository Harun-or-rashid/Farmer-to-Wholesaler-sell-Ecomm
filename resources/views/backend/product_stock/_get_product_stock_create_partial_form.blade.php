<div class="row">
    <div class="col-md-3">
        <div class="form-group @if ($errors->has('product_color')) has-error @endif">
            <label class="control-label">Product Color</label>
            <select name="product_color[]" class="color_append_dom form-control select2">
                <option value="">--Select Color--</option>
                @if(!empty($product_colors))
                    @foreach($product_colors as $product_color)
                        <option value="{!! $product_color->id !!}">{!! $product_color->title !!}</option>
                    @endforeach
                @endif
            </select>

            @if($errors->has('product_color'))
                <span class="help-block">{!! $errors->first('product_color') !!}</span>
            @else
                <span class="help-block"> This field is optional. </span>
            @endif
        </div>
    </div>
    <!--/span-->
    <div class="col-md-2">
        <div class="form-group @if ($errors->has('quantity')) has-error @endif">
            <label class="control-label">Quantity</label>
            <input type="number" name="quantity[]" placeholder="qty" class="form-control" required min="1">

            @if($errors->has('quantity'))
                <span class="help-block">{!! $errors->first('quantity') !!}</span>
            @else
                <span class="help-block"> Required. </span>
            @endif
        </div>
    </div>
    <!--/span-->
    <div class="col-md-1">
        <div class="form-group">
            <label> Action </label>
            <button type="button" class="btn btn-sm btn-primary" onclick="add_new_form()">+</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="remove_this_form(this)">-</button>
        </div>
    </div>
    <!--/span-->
</div>
<!--/row-->