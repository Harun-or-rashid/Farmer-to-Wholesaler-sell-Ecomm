@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
@endsection

@section('page_level_css_files')
    <style>
        .tree, .tree ul {

            margin:0;

            padding:0;

            list-style:none

        }

        .panel-primary > .panel-heading {
            color: #fff;
            background-color: #606ec3;
            border-color: #606ec3;
        }

        .panel-primary {

            border-color: #606ec3;
            margin: 3%;

        }
        .tree ul {

            margin-left:1em;

            position:relative

        }

        .tree ul ul {

            margin-left:.5em

        }

        .tree ul:before {

            content:"";

            display:block;

            width:0;

            position:absolute;

            top:0;

            bottom:0;

            left:0;

            border-left:1px solid

        }

        .tree li {

            margin:0;

            padding:0 1em;

            line-height:2em;

            color:#369;

            font-weight:700;

            position:relative

        }

        .tree ul li:before {

            content:"";

            display:block;

            width:10px;

            height:0;

            border-top:1px solid;

            margin-top:-1px;

            position:absolute;

            top:1em;

            left:0

        }

        .tree ul li:last-child:before {

            background:#fff;

            height:auto;

            top:1em;

            bottom:0

        }

        .indicator {

            margin-right:5px;

        }

        .tree li a {

            text-decoration: none;

            color:#369;

        }

        .tree li button, .tree li button:active, .tree li button:focus {

            text-decoration: none;

            color:#369;

            border:none;

            background:transparent;

            margin:0px 0px 0px 0px;

            padding:0px 0px 0px 0px;

            outline: 0;

        }
        .menu_edit_class a{
            display: inline-block !important;
            margin-left: 10px;
            color: red !important;
        }

        .tree li {
            cursor: default;
        }
        .tree .branch {
            cursor: cell;
        }
    </style>
@endsection

@section('main_content')
    <section class="content">

        @include('backend.layout_partials.messages.success')
        @include('backend.layout_partials.messages.failed')
        @include('backend.layout_partials.messages.form_failed')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="#" class="btn btn-success btn-sm">List</a>
                    </div>
                    <div class="card-body">
                        <div id="sample_2_wrapper" class="">
                            <ul id="tree1">

                                @foreach($categories as $category)

                                    <li>

                                        {{ $category->title }}
                                        @if(count($category->childs))
                                            <i class="fa fa-plus-circle"></i>
                                        @endif
                                        <span class="menu_edit_class">
                                            <a href="{!! route('backend.admin.product.category.edit', $category->id) !!}">Edit</a>
                                        </span>

                                        @if(count($category->childs))

                                            @include('backend.product_category.__category_child_list',['childs' => $category->childs])

                                        @endif

                                    </li>

                                @endforeach

                            </ul>

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="#" class="btn btn-success btn-sm">Create</a>
                    </div>
                    <div class="card-body">
                        <form action="{!! route('backend.admin.product.category.store') !!}" class="horizontal-form" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <h3 class="form-section">Category Info</h3>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title" id="title" value="{!! old('title') !!}"
                                                   class="form-control" placeholder="Enter Category Title" required>

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
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('parent_id')) has-error @endif">
                                            <label for="parent_id" class="control-label">Parent</label>
                                            <select id="parent_id" name="parent_id" class="form-control select2">
                                                <option value="0">Select</option>
                                                @foreach($categories as $rows)
                                                    <option value="{{ $rows->id }}" {!! (old('parent_id') == $rows->id)?'selected':'' !!}>{{ $rows->title }}</option>
                                                    {{--@php($i = 0)
                                                    @if(count($rows->childs))
                                                        @php($i++)
                                                        @include('backend.product_category.__category_child_list_in_select',['childs' => $rows->childs])
                                                    @else
                                                        @php($i = 0)
                                                    @endif--}}
                                                @endforeach
                                            </select>

                                            @if($errors->has('parent_id'))
                                                <span class="help-block">{!! $errors->first('parent_id') !!}</span>
                                            @else
                                                <span class="help-block"> This field is nullable. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('image')) has-error @endif">
                                            <label for="image" class="control-label">Category Image <small>(w:600,h:400)</small></label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <br>
                                            @if($errors->has('image'))
                                                <span class="help-block">{!! $errors->first('image') !!}</span>
                                            @else
                                                <span class="help-block"> This field is nullable. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
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

                            </div>

                            <div class="form-actions left">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Save
                                </button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('page_level_js_plugins')
    <!-- date-range-picker -->
    {{--<script src="{{ asset('adminLTE2/bower_components/moment/min/moment.min.js') }}"></script>--}}
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('page_level_js_scripts')
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });


        $.fn.extend({
            treed: function (o) {

                var openedClass = 'glyphicon-minus-sign';
                var closedClass = 'glyphicon-plus-sign';

                if (typeof o != 'undefined'){
                    if (typeof o.openedClass != 'undefined'){
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined'){
                        closedClass = o.closedClass;
                    }
                };

                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
                tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();

        $('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

        $('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});
    </script>
@endsection
