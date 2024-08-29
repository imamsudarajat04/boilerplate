<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$_title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('dist/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/fh-4.0.1/r-3.0.2/sc-2.4.3/datatables.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dist/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/iconly.css')}}">
    <style>

    </style>
</head>

<body>
<script src="{{asset('dist/assets/static/js/initTheme.js')}}"></script>
<div id="app">
    <x-layouts.dashboard.sidebar></x-layouts.dashboard.sidebar>
    <div id="main" class='layout-navbar navbar-fixed'>
        <x-layouts.dashboard.header></x-layouts.dashboard.header>
        <div id="main-content">
            <div class="page-heading">
                <x-layouts.dashboard.page-header></x-layouts.dashboard.page-header>
                <x-alert></x-alert>
                <section class="section">
                    {{$slot}}
                </section>
            </div>

        </div>
        <x-layouts.dashboard.footer></x-layouts.dashboard.footer>
    </div>

</div>

<script src="{{asset('dist/assets/static/js/components/dark.js')}}"></script>
<script src="{{asset('dist/assets/compiled/js/app.js')}}"></script>
<script src="{{asset('dist/assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/fh-4.0.1/r-3.0.2/sc-2.4.3/datatables.min.js"></script>
<script src="{{asset('dist/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('dist/assets/static/js/pages/form-element-select.js')}}"></script>
@vite(["resources/js/app.js"])

@stack("styles")
@stack("scripts")
</body>

</html>
