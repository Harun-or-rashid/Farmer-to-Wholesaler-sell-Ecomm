<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout_partials._head')
</head>

<body>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <span id="loading-percentage"></span>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
        </div>
    </div>
</div>

<div id="page">

@include('frontend.layout_partials._header')
<!-- /header -->
{{--@include('frontend.layout_partials.messages.failed')
@include('frontend.layout_partials.messages.form_failed')
@include('frontend.layout_partials.messages.success')
@include('frontend.layout_partials.messages.warning')--}}
@yield('main_content')
<!-- /main -->

@include('frontend.layout_partials._footer')
<!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div><!-- Back to top button -->

@include('frontend.layout_partials._scripts')

</body>
</html>