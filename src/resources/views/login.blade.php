<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
        {{-- 登録ページへ遷移 --}}
        <div class="header-link-container">
            <a class="header-link" href="{{ url('/register') }}">register</a>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">Login</h2>
        <form class="main-content-form" action="{{ url('/login') }}" method="POST">
        @csrf
            <div class="main-content-inner">
                <div class="form-group">
                    <p class="form-label">メールアドレス</p>
                    <input class="form-input" type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                    {{-- エラーメッセージの表示 --}}
                    @error('email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <p class="form-label">パスワード</p>
                    <input class="form-input" type="text" name="password"  placeholder="例:coachtech1106" value="{{ old('password') }}">
                    {{-- エラーメッセージの表示 --}}
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- バリデーションエラーがなければ管理画面へ遷移 --}}
            <input class="form-submit-button" type="submit" value="ログイン">
        </form>
    </main>
</body>

</html>