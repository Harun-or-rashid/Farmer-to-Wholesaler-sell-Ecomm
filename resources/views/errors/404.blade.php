@extends('frontend.layouts.master')

@php
    use PhpParser\Node\Expr\Array_;
    $common_data = new Array_();
    $common_data->title = '404 Not Found';
    $common_data->sub_title = '';
    $common_data->main_menu = 'not_found_404';
    $common_data->sub_menu = 'not_found_404';
    $common_data->current_menu = 'not_found_404';

@endphp
{{--
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))--}}

@section('main_content')
    <main class="bg_gray">
        <div id="error_page">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-7 col-lg-9">
                        <img src="{!! asset('assets/frontend/img/404.svg') !!}" alt="" class="img-fluid" width="400" height="212">
                        <p>The page you're looking is not founded!</p>
                        <form action="{!! route('frontend.search-products') !!}" method="GET">
                            <div class="search_bar">
                                <input type="text" class="form-control" placeholder="What are you looking for?" name="q">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /error_page -->
    </main>
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/error_track.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')

@endsection