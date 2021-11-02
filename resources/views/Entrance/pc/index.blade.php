<html>
<head>
</head>
<body>
集客LP
    <form method="POST" action="customer">
        @csrf
    </form>
    <a href="{{ route('customer.register')}}">新規登録</a>
    <a href="{{ route('customer.login')}}">ログイン</a>
</body>
</html>