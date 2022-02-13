<form action="{{ route('shops.passwordReset') }}" method="post">
@csrf
<table>
    <tbody>
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
<button type="submit" name="action" value="submit">
    確認画面へ
</button>
<input type="hidden" name="shop_id" value="{{$shopData['id']}}">
</form>
