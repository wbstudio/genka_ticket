<form action="{{ route('shops.confirmRegistEmail') }}" method="post">
@csrf
<table>
    <thead>
        <tr>
            <th>

            </th>
            <td>

            </td>
        </tr>
    </thead>
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
                <li>{{ $error }}</li>
            @endforeach
<button type="submit" name="action" value="submit">
    確認画面へ
</button>
</form>
