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
                                <form action="{!! route('backend.admin.page.contact-us.edit') !!}" class="horizontal-form"
                                      method="post">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('support_mail')) has-error @endif">
                                                    <label class="control-label">Support Mail</label>
                                                    <input type="email" name="support_mail" value="{!! $contact_us->support_mail !!}" id="support_mail" class="form-control" placeholder="Enter website support mail" required>
                                                    @if($errors->has('support_mail'))
                                                        <span class="text-danger">{!! $errors->first('support_mail') !!}</span>
                                                    @else
                                                        <span class="help-block"> [This field is required]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('contact_mail')) has-error @endif">
                                                    <label class="control-label">Support Mail</label>
                                                    <input type="email" name="contact_mail" id="contact_mail" value="{!! $contact_us->contact_mail !!}" class="form-control" placeholder="Enter website contact mail" required>
                                                    @if($errors->has('contact_mail'))
                                                        <span class="text-danger">{!! $errors->first('contact_mail') !!}</span>
                                                    @else
                                                        <span class="help-block"> [This field is required]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('office_phone')) has-error @endif">
                                                    <label class="control-label">Office Phone</label>
                                                    <input type="text" name="office_phone" id="office_phone" value="{!! $contact_us->office_phone !!}" class="form-control" placeholder="Enter office phone number">
                                                    @if($errors->has('office_phone'))
                                                        <span class="text-danger">{!! $errors->first('office_phone') !!}</span>
                                                    @else
                                                        <span class="help-block"> [This field is nullable]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('fax')) has-error @endif">
                                                    <label class="control-label">Fax</label>
                                                    <input type="text" name="fax" id="fax" class="form-control" value="{!! $contact_us->fax !!}" placeholder="Enter fax">
                                                    @if($errors->has('fax'))
                                                        <span class="text-danger">{!! $errors->first('fax') !!}</span>
                                                    @else
                                                        <span class="help-block"> [This field is nullable]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group @if ($errors->has('contact_text')) has-error @endif">
                                                    <label class="control-label">Text</label>
                                                    <textarea name="contact_text" id="contact_text"
                                                              class="form-control editor" required>{!! $contact_us->contact_text !!}</textarea>

                                                    @if($errors->has('contact_text'))
                                                        <span class="text-danger">{!! $errors->first('contact_text') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group @if ($errors->has('address')) has-error @endif">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" name="address" id="address" value="{!! $contact_us->address !!}" class="form-control" required>
                                                    @if($errors->has('address'))
                                                        <span class="text-danger">{!! $errors->first('address') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
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
