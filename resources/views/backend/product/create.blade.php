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
                        <a href="{!! route('backend.admin.products.index') !!}" class="btn btn-success btn-sm">List</a>
                        <div class="tools">

                        </div>
                    </div>
                    <div class="card-body form">
                        <!-- BEGIN FORM-->
                        <form action="{!! route('backend.admin.products.store') !!}" class="horizontal-form" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <h3 class="form-section">Product Info</h3>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title" id="title" value="{!! old('title') !!}"
                                                   class="form-control" placeholder="Enter Product Title" required>

                                            @if($errors->has('title'))
                                                <span class="help-block">{!! $errors->first('title') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group @if ($errors->has('price')) has-error @endif">
                                            <label class="control-label">Price</label>
                                            <input type="number" min="0" step="0.01" name="price" id="price" value="{!! old('price') !!}"
                                                   class="form-control" placeholder="Enter Product Price" required>

                                            @if($errors->has('price'))
                                                <span class="help-block">{!! $errors->first('price') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group @if ($errors->has('sell_price')) has-error @endif">
                                            <label class="control-label">Sell Price</label>
                                            <input type="number" min="0" step="0.01" name="sell_price" id="sell_price" value="{!! old('sell_price') !!}" oninput="changeSellPrice(this)"
                                                   class="form-control" placeholder="Enter Product Sell Price" required>

                                            @if($errors->has('sell_price'))
                                                <span class="help-block">{!! $errors->first('sell_price') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row" id="emi_wrapper">
                                    <div class="col-md-4">
                                        <div class="form-group @if ($errors->has('emi')) has-error @endif">
                                            <label class="control-label">EMI</label>
                                            <select name="emi" id="emi" class="form-control">
                                                <option value="0" {!! (old('emi') == 0)?'selected':'' !!}>Not-Available</option>
                                                <option value="1" {!! (old('emi') == 1)?'selected':'' !!}>Available</option>
                                            </select>

                                            @if($errors->has('emi'))
                                                <span class="help-block">{!! $errors->first('emi') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group @if ($errors->has('category')) has-error @endif">
                                            <label class="control-label">Category</label>
                                            <select name="category" id="category" class="form-control select2" required>
                                                <option value="">--Select Category--</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                        <option value="{!! $category->id !!}" {!! (old('category') == $category->id)?'selected':'' !!}>{!! $category->title !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if($errors->has('category'))
                                                <span class="help-block">{!! $errors->first('category') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group @if ($errors->has('sub_category')) has-error @endif">
                                            <label class="control-label">Sub Category</label>
                                            <select name="sub_category" id="sub_category" class="form-control select2">
                                                <option value="">--Select Category First--</option>
                                            </select>

                                            @if($errors->has('sub_category'))
                                                <span class="help-block">{!! $errors->first('sub_category') !!}</span>
                                            @else
                                                <span class="help-block"> This field is nullable. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group @if ($errors->has('short_text')) has-error @endif">
                                            <label for="short_text" class="control-label">Product Short Text</label>
                                            <textarea name="short_text" id="short_text" class="form-control ckeditor" required>{!! old('short_text') !!}</textarea>

                                            @if($errors->has('short_text'))
                                                <span class="help-block">{!! $errors->first('short_text') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                                            <label for="description" class="control-label">Product Description</label>
                                            <textarea name="description" id="description" class="form-control ckeditor" required>{!! old('description') !!}</textarea>

                                            @if($errors->has('description'))
                                                <span class="help-block">{!! $errors->first('description') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label">Image</label>
                                    <div id="product-image-wrapper">
                                        <div class="form-group form-inline @if ($errors->has('images')) has-error @endif">
                                            <div class="image-group">
                                                <input type="file" class="form-control" name="images[]" required>
                                                &nbsp;
                                                <button type="button" class="btn btn-xs btn-primary" onclick="addNewImageField()"><i class="fa fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->has('images'))
                                        <span class="help-block">{!! $errors->first('images') !!}</span>
                                    @else
                                        <span class="help-block">  This field is required. </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group @if ($errors->has('featured')) has-error @endif">
                                        <label for="featured" class="control-label">Featured ? </label>
                                        <input type="checkbox" name="featured" value="1" id="featured">
                                        <br>
                                        @if($errors->has('featured'))
                                            <span class="help-block">{!! $errors->first('featured') !!}</span>
                                        @else
                                            <span class="help-block"> This field is nullable. </span>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group @if ($errors->has('slider')) has-error @endif">
                                        <label for="slider" class="control-label">Available in Slider ? </label>
                                        <input type="checkbox" name="slider" value="1" id="slider">
                                        <br>
                                        @if($errors->has('slider'))
                                            <span class="help-block">{!! $errors->first('slider') !!}</span>
                                        @else
                                            <span class="help-block"> This field is nullable. </span>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('published')) has-error @endif">
                                        <label for="published" class="control-label">Published ? </label>
                                        <select name="published" id="published" class="form-control" required onchange="changePublished(this)">
                                            <option value="1" {!! (old('published') == 1)?'selected':'' !!}>Published</option>
                                            <option value="2" {!! (old('published') == 2)?'selected':'' !!}>Upcoming Product</option>
                                        </select>
                                        @if($errors->has('published'))
                                            <span class="help-block">{!! $errors->first('published') !!}</span>
                                        @else
                                            <span class="help-block"> This field is nullable. </span>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4" id="upcoming_text_wrapper">
                                    <div class="form-group @if ($errors->has('upcoming_text')) has-error @endif">
                                        <label for="upcoming_text" class="control-label">Upcoming Text </label>
                                        <input type="text" name="upcoming_text" id="upcoming_text" class="form-control" value="{!! old('upcoming_text') !!}">
                                        @if($errors->has('upcoming_text'))
                                            <span class="help-block">{!! $errors->first('upcoming_text') !!}</span>
                                        @else
                                            <span class="help-block"> This field is nullable. </span>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->

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
            changeSellPrice($("#sell_price"))
            changePublished($("#published"))
        });

        $("select[name='category']").on('change', function(){
            var append_dom = $("#sub_category");
            var category_id = $("select[name='category']").val();
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
        });

        function addNewImageField() {
            let html_content = $("#image_new_field_hidden_data").html();
            $("#product-image-wrapper").append(html_content);
        }

        function removeImageField(button) {
            $(button).parent().parent().remove();
        }

        function changeSellPrice(sell_input) {
            var sell_price = parseInt($(sell_input).val());
            if (sell_price >= 5000) {
                $("#emi").attr("disabled", false);
                $("#emi").attr("title", "Select Emi Available Or Not.");
            } else {
                $("#emi").attr("disabled", true);
                $("#emi").attr("title", "Emi only available if sell price is greater then 5000 Tk.");
            }
        }

        function changePublished(select_element) {
            var published = $(select_element).val();
            if (published == 1) {
                $("#upcoming_text_wrapper").hide();
            } else {
                $("#upcoming_text_wrapper").show();
            }
        }
    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
