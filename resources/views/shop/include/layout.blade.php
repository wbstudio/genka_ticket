<html>
    <head>
        <title> - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
        <!--css-->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{ asset('css/customer/sp/common.css') }}"> -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!--js-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        @yield('head')
    </head>
    <body>
        <header>
            @include('shop.include.header')
        </header>
        <main>
        <div id="content" class="content">
            @yield('content')
        </div>
        </main>
        
        <footer>
            @include('shop.include.footer')
        </footer>
    </body>
</html>