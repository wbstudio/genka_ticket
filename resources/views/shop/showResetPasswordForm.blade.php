<form action="{{ route('shops.sendResetPasswordMail') }}" method="post">
@csrf
<table>
    <tbody>
        <tr>
            <th>
                アドレス
            </th>
            <td>
                <input type="text" name="email" value="">
            </td>
        </tr>
    </tbody>
</table>
<button type="submit" name="action" value="submit">
    送信する
</button>
</form>