<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('pagetitle', 'ParkitectNexus - Share your mods, blueprints and parks')</title>

    <meta name="description" content="Here you will find mods, coasters and parks created by players for Parkitect.  We already have 68 mods, 785 blueprints and 113 parks ready for download!"/>

    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" media="screen" type="text/css" href="{{ elixir('css/app.css') }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css">

    @yield('css')

    @yield('head')
</head>
<body>
@section('body')
    @include('partials.topbar')

    <div class="container" id="site">
        <div class="row">
            @yield('fullcontent')
        </div>
    </div>
    <div class="container" id="footer">
        @include('partials.footer')
    </div>
@show

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>
<script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
@yield('js')
</body>
</html>
