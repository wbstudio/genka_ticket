<form action="{{ route('shops.completeRegistEmail') }}" method="post">
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
<button type="submit" name="action" value="submit">
    登録する
</button>
<button type="submit" name="action" value="back">
    修正する
</button>
</form>