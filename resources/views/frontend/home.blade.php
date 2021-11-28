
@extends('frontend.layouts.master')

@section('main_content')
    <main>
        @include('frontend.layout_partials.home._carousel')
        <!--/carousel-->

        @include('frontend.layout_partials.home._banner_grid')
        <!--/banners_grid -->

        @include('frontend.layout_partials.home._top_selling')
        <!-- /container -->

        @include('frontend.layout_partials.home._featured')

        @include('frontend.layout_partials.home._upcoming_products')
        <!-- /container -->
    </main>
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/home_1.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel-home.min.js') !!}"></script>
@endsection