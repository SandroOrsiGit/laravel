<!DOCTYPE HTML>
<!--
 Stellar by HTML5 UP
 html5up.net | @ajlkn
 Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Stellar by HTML5 UP</title>
    @include('includes/meta-tags')
    @include('includes/css-links')
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            @yield('header')
        </header>

        <!-- Nav -->
        @include('includes.nav')

        <!-- Main -->
        <div id="main">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('includes/footer')

    </div>

    <!-- Scripts -->
    @include('includes.jquery-scripts')

</body>

</html>
