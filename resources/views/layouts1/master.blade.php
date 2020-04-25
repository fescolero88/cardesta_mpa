<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        <title>CarDesta - @yield('title')</title>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta name="description" content="@yield('description')">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
        
    </head>
    <body>
        @include('includes.header')
        @yield('content')
        @include('includes.navigation')
        @include('includes.style')
        @include('includes.script')
        @yield('footer-script')
        @include('includes.footer')
        
    </body>
</html>
