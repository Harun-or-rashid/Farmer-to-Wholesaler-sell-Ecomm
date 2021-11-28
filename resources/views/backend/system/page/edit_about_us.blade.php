@extends('backend.layouts.master')

@section('page_level_css_plugins')

@endsection

@section('page_level_css_files')

@endsection

@section('main_content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3>About Us Page</h3>
                <div class="tools">

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ml-5">
                        <div class="portlet">
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                @include('backend.layout_partials.messages.success')
                                @include('backend.layout_partials.messages.failed')
                                @include('backend.layout_partials.messages.form_failed')
                                <form action="{!! route('backend.admin.page.about-us.edit') !!}" class="horizontal-form"
                                      method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group @if ($errors->has('about_text')) has-error @endif">
                                                    <label class="control-label">Text</label>
                                                    <textarea name="about_text" id="about_text"
                                                              class="form-control editor" required>{!! $about_us->about_text !!}</textarea>

                                                    @if($errors->has('about_text'))
                                                        <span class="text-danger">{!! $errors->first('about_text') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('image')) has-error @endif">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="image" id="image"
                                                           class="form-control" placeholder="Image">
                                                    @if($errors->has('image'))
                                                        <span class="text-danger">{!! $errors->first('image') !!}</span>
                                                    @else
                                                        <span class="help-block"> [If you don't want to change keep it blank]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <div class="form-actions left">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>

                                        <button type="reset" class="btn btn-default" data-toggle="tooltip" title="List">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer ml-5">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')
    <!-- Ckeditor -->
    <script src="{!! asset('assets/backend/plugins/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('assets/backend/plugins/ckeditor/adapters/jquery.js') !!}"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')
    <script>
        $( 'textarea.editor' ).ckeditor();
    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
