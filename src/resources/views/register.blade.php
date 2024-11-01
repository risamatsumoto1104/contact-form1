<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
        {{-- ログインページへ遷移 --}}
        <div class="header-link-container">
            <a class="header-link" href="{{ url('/login') }}">login</a>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">Register</h2>
        <form class="main-content-form" action="">
            <div class="main-content-inner">
                <div class="form-group">
                    <p class="form-label">お名前</p>
                    <input class="form-input" type="text" name="name" placeholder="例:山田 太郎">
                </div>
                    <div class="form-group">
                    <p class="form-label">メールアドレス</p>
                    <input class="form-input" type="text" name="email" placeholder="例:test@example.com">
                </div>
                <div class="form-group">
                    <p class="form-label">パスワード</p>
                    <input class="form-input" type="text" name="password" placeholder="例:coachtech1106">
                </div>
            </div>
            {{-- バリデーションエラーがなければログイン画面へ遷移 --}}
            <input class="form-submit-button" type="submit" value="登録">
        </form>
    </main>
</body>

</html>