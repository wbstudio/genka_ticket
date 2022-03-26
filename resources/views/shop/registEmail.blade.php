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
                <form action="{{ route('shops.confirmRegistEmail') }}" method="post">
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
                                    <input type="text" name="email" value="{{ old('email') }}">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    パスワード<span class="asterisk">＊</span>
                                </th>
                                <td>
                                    <input type="password" name="password" value="">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    確認用<span class="asterisk">＊</span>
                                </th>
                                <td>
                                    <input type="password" name="confirm_password" value="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @foreach ($errors->all() as $error)
                    <li style="color:#F00;text-align:center;">{{ $error }}</li>
                    @endforeach
                    <div class="rule_area">
                        <div class="title">
                            利用規約
                        </div>
                        <div class="rule_box">
                            @include('shop.include.rule')
                        </div>
                        <div class="chk">
                            <input type="checkbox" class="chk_rule">
                            利用規約を読み理解しました。
                        </div>
                    </div>
                    <div class="button_area">
                        <button type="submit" name="action" value="submit" disabled class="submit">
                            確認画面へ
                        </button>
                    </div>
                </form>
            </div>
        </main>
        <footer>
            @include('shop.include.attract_footer')
        </footer>        
    </body>
</html>
