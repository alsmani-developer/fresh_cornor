<!doctype html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/site/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/site/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/site/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/site/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/site/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/site/style.css')}}">
    @if ($locale == 'ar')
    <link rel="stylesheet" href="{{asset('css/site/style-rtl.css')}}">
    @endif
    <link rel="shortcut icon" type="image/webp" href="{{asset('images/logo.jpg')}}">
    <link rel="apple-touch-icon"  href="{{asset('images/logo.jpg')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="{{config('app.name')}}">
    <meta name="theme-color" content="#191A21">
    <script src="{{ asset('js/site/jquery.min.js') }}"></script>