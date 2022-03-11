<html>
<head>
<link rel="stylesheet" href="{{ asset('css/shop/login.css') }}">
</head>
<body>
    <div id="member_outside">
        <div class="bar">
            <span>パスワードリセット完了</span>
        </div>

        <div class="form_area">
            <div class="memo">
                パスワードの再設定が完了しました。
            </div>
            <div class="button_area">
                <a href="{{ route('shops.login')}}">ログイン画面へ</a>
            </div>

        </div>
    </div>
</body>
</html>