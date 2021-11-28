<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Abu Bin Oalid">
<title>{{ $system_website_information->website_title }}</title>

<!-- Favicons-->
<link rel="shortcut icon" href="{{ asset($system_website_information->favicon) }}" type="image/x-icon">
{{--<link rel="apple-touch-icon" type="image/x-icon" href="{!! asset('assets/frontend/img/apple-touch-icon-57x57-precomposed.png') !!}">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{!! asset('assets/frontend/img/apple-touch-icon-72x72-precomposed.png') !!}">
<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{!! asset('assets/frontend/img/apple-touch-icon-114x114-precomposed.png') !!}">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{!! asset('assets/frontend/img/apple-touch-icon-144x144-precomposed.png') !!}">--}}

@include('frontend.layout_partials._styles')