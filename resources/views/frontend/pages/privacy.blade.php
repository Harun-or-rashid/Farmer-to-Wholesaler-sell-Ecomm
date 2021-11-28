
@extends('frontend.layouts.master')

@section('main_content')

    <main class="bg_gray">

        <div class="container margin_60">
            <h4>Our Privacy & Policy</h4>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eleifend libero ac est eleifend, id vestibulum nulla sodales. Donec vitae ex a libero tristique cursus. In orci diam, cursus id sapien vel, dictum vestibulum quam. Praesent tellus urna, maximus a aliquam non, volutpat et risus. In malesuada non odio et ullamcorper. Praesent commodo rutrum semper. Sed vitae nunc a justo vulputate pretium eget eu orci. Vivamus iaculis mi at cursus commodo. Sed consectetur libero eget magna vulputate aliquam sit amet non felis. Cras sed euismod est. Donec eget ligula sem. In id sapien sed odio efficitur fermentum. Sed et cursus est. Donec finibus a augue sit amet ultricies. Quisque ac quam ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                <br>
                <br>
                Donec sit amet libero ut mi efficitur varius vitae vel mi. Fusce posuere efficitur mollis. Vivamus varius mauris sit amet nisi placerat, in sollicitudin ligula malesuada. Nam vel porttitor enim. Cras gravida eleifend tellus. Sed mauris metus, porta vitae augue eu, hendrerit ultrices magna. Vivamus malesuada aliquet risus. Nullam vel fringilla nulla. Suspendisse ut neque ultricies, tempor libero non, lacinia purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque scelerisque mauris nec libero accumsan, non accumsan libero consectetur.
                <br>
                <br>
                Curabitur blandit magna nulla, non auctor erat tincidunt ac. Curabitur feugiat mattis ex. Sed sodales rhoncus tortor, at posuere massa. Praesent eget quam mi. Pellentesque ac vehicula ligula. Nullam a purus non ante dapibus consectetur in eget nulla. Sed vehicula bibendum efficitur. Donec tempor id justo id condimentum. Proin ut mauris ante. Nulla fermentum arcu id urna auctor, vitae suscipit tortor vulputate. Aliquam erat volutpat.
                <br>
                <br>
                Donec et odio non justo tincidunt auctor. Vestibulum sollicitudin tellus vel lorem bibendum, sit amet pellentesque eros blandit. In ut venenatis purus, sed suscipit magna. Aliquam maximus tempor turpis, sit amet mattis metus cursus id. Sed ut lacinia libero, ut placerat mauris. Nullam malesuada sollicitudin quam, laoreet rhoncus risus ultricies eu. Nulla quis fringilla justo. Duis consequat sollicitudin faucibus. Phasellus vel nisl vulputate, molestie eros et, fermentum turpis. Aliquam pulvinar est id accumsan hendrerit.
                <br>
                <br>
                Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam et justo non risus molestie lobortis vitae sit amet mauris. Suspendisse non nisl non nulla euismod hendrerit. Nulla lectus est, condimentum et dui id, pulvinar consequat est. In hac habitasse platea dictumst. Quisque efficitur libero purus, ac varius sapien tempus ut. Nulla pharetra justo augue, eget aliquam erat laoreet sed. Praesent nec feugiat quam. Aenean porta risus at sem dictum ultricies. Maecenas venenatis, erat vel hendrerit aliquet, ante leo volutpat libero, id varius nulla elit nec ligula. Nam id pellentesque velit. Fusce aliquam, est id interdum efficitur, lorem velit tempor diam, non dictum massa nisi a mi.
            </p>
            <!-- /row -->
        </div>
        <!-- /container -->

        <!-- /bg_white -->
    </main>

    <!--/main-->
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/about.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel-home.min.js') !!}"></script>
@endsection
