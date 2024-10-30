<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
</head>

<body>
    <header>
        <div>
            <h1>FashionablyLate</h1>
            <form action="">
                <div>
                    <button>login</button>
                </div>
            </form>
        </div>
    </header>

    <main>
        <h2>Register</h2>
        <form action="">
            <div>
                <p>お名前</p>
                <input type="text">
            </div>
            <div>
                <p>メールアドレス</p>
                <input type="text">
            </div>
            <div>
                <p>パスワード</p>
                <input type="text">
            </div>
            <input type="submit" value="登録">
        </form>
    </main>
</body>

</html>