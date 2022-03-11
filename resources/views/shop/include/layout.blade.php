<html>
    <head>
        <title> - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
        <!--css-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/shop/common.css') }}">
        <!--js-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        @yield('head')
    </head>
    <body>
        <main>
            <div id="side_navi" class="side_navi">
                @include('shop.include.side_navi')
            </div>
            <div id="content" class="content">
                @yield('content')
                <footer>
                    @include('shop.include.footer')
                </footer>

            </div>
        </main>
        
    </body>
</html>