<html>
<head>
<link rel="stylesheet" href="{{ asset('css/shop/login.css') }}">
</head>
<body>
    <div id="member_outside">
        <div class="bar">
            <span>パスワードリセット画面</span>
        </div>

        <div class="form_area">
            <div class="memo">
                ご登録のアドレスを入力してください。
            </div>
            <form action="{{ route('shops.sendResetPasswordMail') }}" method="post">
            @csrf
            <table>
                <colgroup> 
                    <col style='width: 30%;'>
                    <col style='width: 70%;'>
                </colgroup>
                <tbody>
                    <tr>
                        <td>
                            アドレス
                        </td>
                        <td>
                            <input type="text" name="email" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="button_area">
                <button type="submit" name="action" value="submit">
                    送信する
                </button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>