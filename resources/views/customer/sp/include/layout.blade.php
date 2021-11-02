<html>
    <head>
        <title> - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
        <!--css-->
        <link rel="stylesheet" href="{{ asset('css/customer/sp/common.css') }}">
        <!--js-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="{{ asset('js/customer/sp/common.js') }}"></script>
        @yield('head')
    </head>
    <body>
        <header>
            @include('customer.sp.include.header')
        </header>
            @include('customer.sp.include.menu_modal')
        <main>
        <div id="content" class="content">
            @yield('content')
        </div>
        </main>
        
        <footer>
            @include('customer.sp.include.footer')
        </footer>
    </body>
</html>