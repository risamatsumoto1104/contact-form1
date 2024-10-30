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
    <header class="header">
        <div class="header-container">
            <h1 class="header-title">FashionablyLate</h1>
            <form class="header-form" action="">
                <div class="header-button-container">
                    <button class="header-button">login</button>
                </div>
            </form>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">Register</h2>
        <form class="main-content-form" action="">
            <div class="form-group">
                <p class="form-label">お名前</p>
                <input class="form-input" type="text" name="name">
            </div>
            <div class="form-group">
                <p class="form-label">メールアドレス</p>
                <input class="form-input" type="text" name="email">
            </div>
            <div class="form-group">
                <p class="form-label">パスワード</p>
                <input class="form-input" type="text" name="password">
            </div>
            <input class="form-submit-button" type="submit" value="登録">
        </form>
    </main>
</body>

</html>