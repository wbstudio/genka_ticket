<html>
    <head>
        <title>原価ticket【協力店募集ページ】</title>
        <meta property="og:title" content="原価ticket【協力店募集ページ】" />
        <meta property="og:type" content="【飲食店必見】無料で集客力を上げる方法。" />
        <meta property="og:description" content="飲食店必見、無料で集客力を上げる方法。" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="飲食店,集客,売上,無料,集客力を上げる,飲食">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
        <meta name="description" content="飲食店必見、無料で集客力を上げる方法。">
        <meta charset="UTF-8">
        <!--css-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/shop/attract.css') }}">
        <!--js-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="{{ asset('js/shop/attract.js') }}"></script>
    </head>
    <body>
        <main>
            <div id="content" class="content">
                <div class="container">
                    <h4>原価ticket協力店登録フォーム</h4>

                    <form action="{{ route('shops.completeRegistEmail') }}" method="post">
                        @csrf
                        <table>
                            <colgroup>
                                <col style="width:20%;">
                                <col style="width:80%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>
                                        アドレス
                                    </th>
                                    <td>
                                        {{ $inputs['email']  }}
                                        <input type="hidden" name="email" value="{{ $inputs['email']  }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        パスワード<span class="asterisk">＊</span>
                                    </th>
                                    <td>
                                        {{$inputs['password_display']}}
                                        <input type="hidden" name="password" value="{{$inputs['password']}}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="button_area">
                            <button type="submit" name="action" value="submit" class="submit">
                                登録する
                            </button>
                            <button type="submit" name="action" value="back" class="return">
                                修正する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <footer>
            @include('shop.include.attract_footer')
        </footer>        
    </body>
</html>
