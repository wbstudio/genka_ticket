<html>
<head>
<link rel="stylesheet" href="{{ asset('css/shop/login.css') }}">
</head>
<body>
    <div id="member_outside">

        <div class="bar">
            <span>店舗管理ログイン画面</span>
        </div>

        <div class="form_area">
            <form method="POST" action="admin">
                @csrf
                <div class="p-3">
                    @error('auth')
                    <div class="error_message">
                        &#x26A0; {{ $message }}
                    </div>
                    @enderror
                    <table>
                        <colgroup> 
                            <col style='width: 30%;'>
                            <col style='width: 70%;'>
                        </colgroup>

                        <tr>
                            <td>
                                メールアドレス    
                            </td>
                            <td>
                                <input class="" type="text" name="email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                パスワード    
                            </td>
                            <td>
                                <input class="" type="password" name="password">        
                            </td>
                        </tr>
                    </table>
                    <div class="button_area">
                        <button class="" type="submit">ログイン</button>
                    </div>
                </div>
            </form>
            <div class="password_reset">
                パスワードを忘れた方は
                <a href="{{ route('shops.showResetPasswordForm')}}">こちら</a>
            </div>
        </div>
    </div>
</body>
</html>