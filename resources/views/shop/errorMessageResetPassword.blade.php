<html>
<head>
<link rel="stylesheet" href="{{ asset('css/shop/login.css') }}">
</head>
<body>
    <div id="member_outside">
        <div class="bar">
            <span>エラー</span>
        </div>

        <div class="form_area">
            <div class="memo">
                メール送信後、30分以上経過したため、<br>
                パスワードリセットリンクが無効になりました。             
            </div>
            <div class="button_area">
                <a href="{{ route('shops.showResetPasswordForm')}}">パスワード再設定へ</a>
                <a href="{{ route('shops.login')}}">ログイン画面へ</a>
            </div>

        </div>
    </div>
</body>
</html>