<html>

<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <form method="POST" action="{{ route('customer.regist') }}">
        @csrf
        <div class="p-3">
            <label class="block">名前</label>
            <input class="border rounded mb-3 px-2 py-1 @error('name') is-invalid bg-red-200 @enderror" type="text" name="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label class="block">メールアドレス</label>
            <input class="border rounded mb-3 px-2 py-1 @error('email') is-invalid bg-red-200 @enderror" type="email" name="email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <button class="bg-blue-500 text-white rounded px-3 py-2" type="submit">登録</button>
        </div>
    </form>
</body>

</html>