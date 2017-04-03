<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.meta')

    @yield('title')

    @include('layouts.css')

    @yield('css')

    @include('layouts.shim')

</head>

<body role="document">

    @include('layouts.nav')

    <div class="container theme-showcase" role="main">

    @yield('content')

    @include('layouts.bottom')

    </div> <!-- /container -->

    @include('layouts.scripts')

    @yield('scripts')

</body>
</html>