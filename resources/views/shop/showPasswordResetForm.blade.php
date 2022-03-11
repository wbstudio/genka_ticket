<html>
<head>
<link rel="stylesheet" href="{{ asset('css/shop/login.css') }}">
</head>
<body>
    <div id="member_outside">

        <div class="bar">
            <span>パスワード再設定画面</span>
        </div>

        <div class="form_area">
            <form action="{{ route('shops.passwordReset') }}" method="post">
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
                                パスワード    
                            </td>
                            <td>
                                <input type="password" name="password" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                確認用   
                            </td>
                            <td>
                                <input type="password" name="confirm_password" value="">       
                            </td>
                        </tr>
                    </table>
                    <div class="button_area">
                        <button class="" type="submit">ログイン</button>
                    </div>
                </div>
                <input type="hidden" name="shop_id" value="{{$shopData['id']}}">
            </form>
        </div>
    </div>
</body>
</html>
