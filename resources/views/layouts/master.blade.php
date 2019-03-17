<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>

    <header class="row">
        <div class="container">
            @include('includes.header')
        </div>
    </header>
    <div id="main">
        @yield('content')
    </div>
    <div style="clear: both;"></div>

    <footer id="footer">
        @include('includes.footer')
    </footer>

</body>
</html>



