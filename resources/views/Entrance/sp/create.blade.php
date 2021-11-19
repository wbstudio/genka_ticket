<html>
<head>
</head>
<body>
集客LP
    <form method="POST" action="customer">
        @csrf
        <div>{{ $userData['email'] }}</div>
    </form>
</body>
</html>