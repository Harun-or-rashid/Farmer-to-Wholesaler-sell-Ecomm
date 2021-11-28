@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
@endsection

@section('page_level_css_files')
    <style>

    </style>
@endsection

@section('main_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        @include('backend.layout_partials.messages.success')
        @include('backend.layout_partials.messages.failed')
        @include('backend.layout_partials.messages.form_failed')

        <div class="row">
            <div class="col-md-12 ">
                <div class="card card-primary m-2">
                    <div class="card-header">
                        <a href="{!! route('backend.admin.product.stock.stock-list') !!}" class="btn btn-success btn-sm">List</a>
                        <div class="tools">

                        </div>
                    </div>
                    <div class="card-body form">
                        <!-- BEGIN FORM-->
                        <form action="{!! route('backend.admin.product.stock.store') !!}" class="horizontal-form" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group @if ($errors->has('product_category')) has-error @endif">
                                            <label class="control-label">Product Category</label>
                                            <select name="product_category" class="form-control select2" required onchange="getSubCategories(this.value)">
                                                <option value="">--Select Product Category--</option>
                                                @if(!empty($product_categories))
                                                    @foreach($product_categories as $product_category)
                                                        <option value="{!! $product_category->id !!}">{!! $product_category->title !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if($errors->has('product_category'))
                                                <span class="help-block">{!! $errors->first('product_category') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group @if ($errors->has('sub_category')) has-error @endif">
                                            <label class="control-label">Sub Category</label>
                                            <select name="sub_category" id="sub_category" class="form-control select2" required onchange="getProducts(this.value)">
                                                <option value="">--Select Category First--</option>
                                            </select>

                                            @if($errors->has('sub_category'))
                                                <span class="help-block">{!! $errors->first('sub_category') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group @if ($errors->has('product')) has-error @endif">
                                            <label class="control-label">Product</label>
                                            <select name="product" id="product" class="form-control select2" required>
                                                <option value="">--Select Category First--</option>
                                            </select>

                                            @if($errors->has('product'))
                                                <span class="help-block">{!! $errors->first('product') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div id="product_stock_append_list">
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
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <!--/append row-->
                            </div>

                            <div class="form-actions">
                                <div class="ml-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

    <div class="hidden" style="display: none;">
        <div id="image_new_field_hidden_data">
            <div class="form-group form-inline">
                <div class="image-group">
                    <input type="file" class="form-control" name="images[]" required>
                    &nbsp;
                    <button type="button" class="btn btn-xs btn-primary" onclick="addNewImageField()"><i class="fa fa-plus-circle"></i></button>
                    <button type="button" class="btn btn-xs btn-danger" onclick="removeImageField(this)"><i class="fa fa-minus-circle"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Ckeditor -->
    <script src="{!! asset('assets/backend/plugins/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('assets/backend/plugins/ckeditor/adapters/jquery.js') !!}"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')

    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $( 'textarea.editor' ).ckeditor();
        });

        function getSubCategories(category_id){
            var append_dom = $("#sub_category");
            if (category_id != '') {
                var csrf_token = $("[name='_token']").val();
                var post_url = "{!! route('backend.admin.products.get-sub-categories-by-category') !!}";

                $.ajax({
                    type: "POST",
                    url: post_url,
                    data: {category_id: category_id, _token: csrf_token},
                    success: function( data ) {
                        append_dom.html(data);
                        $('#sub_category').trigger('change');
                    }
                });

            } else {
                append_dom.html('<option value="">--Select Category First</option>');
                $('#sub_category').trigger('change');
            }
        }
        function getProducts(category_id) {
            var append_dom = $("#product");
            if (category_id != '') {
                var csrf_token = $("[name='_token']").val();
                var post_url = "{!! route('backend.admin.product.stock.get-products-by-category') !!}";

                $.ajax({
                    type: "POST",
                    url: post_url,
                    data: {category_id: category_id, _token: csrf_token},
                    success: function( data ) {
                        append_dom.html(data);
                        append_dom.trigger('change');
                    }
                });

            } else {
                append_dom.html('<option value="">--Select Category First</option>');
                append_dom.trigger('change');
            }
        }

        function add_new_form() {
            var append_dom = $("#product_stock_append_list");
            var csrf_token = $("[name='_token']").val();
            var post_url = "{!! route('backend.admin.product.stock.get-create-partial-form') !!}";

            $.ajax({
                type: "POST",
                url: post_url,
                data: {_token: csrf_token},
                success: function( data ) {
                    append_dom.append(data);
                    $('.select2').select2();
                }
            });
        }
        function remove_this_form(button) {
            $(button).parent().parent().parent().remove();
        }

    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
