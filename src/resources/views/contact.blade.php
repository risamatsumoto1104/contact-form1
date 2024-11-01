<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">Contact</h2>
        <form class="content-form" action="">
            <div class="content-form-group">
                <p class="content-form-label-required">お名前</p>
                <div class="content-form-inner-name">
                    <input class="form-input-name" type="text" name="last_name" placeholder="例:山田" >
                    <input class="form-input-name"  type="text" name="first_name" placeholder="例:太郎" >
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">性別</p>
                <div class="content-form-inner-radio">
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender">男性</label>
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender">女性</label>
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender">その他</label>
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">メールアドレス</p>
                <div class="content-form-inner">
                    <input class="form-input" type="email" name="email" placeholder="例:test@example.com">
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">電話番号</p>
                <div class="content-form-inner-tel">
                    <input class="form-input-tel" type="tel" name="tell" placeholder="080">
                    <p class="tel-hyphen">-</p>
                    <input class="form-input-tel" type="tel" name="tell" placeholder="1234">
                    <p class="tel-hyphen">-</p>
                    <input class="form-input-tel" type="tel" name="tell" placeholder="5678">
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">住所</p>
                <div class="content-form-inner">
                    <input class="form-input" type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" >
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label">建物名</p>
                <div class="content-form-inner">
                    <input class="form-input" type="text" name="building" placeholder="例:千駄ヶ谷マンション101" >
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">お問い合わせの種類</p>
                <div class="content-form-inner-select">
                    <span>
                        <select class="form-select">
                            <option value="">選択してください</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="content-form-group">
                <p class="content-form-label-required">お問い合わせ内容</p>
                <textarea class="form-textarea" name="detail" placeholder="お問い合わせ内容をご記載ください"></textarea>
            </div>
        </form>
        {{-- 確認画面ページへ遷移 --}}
        <div class="content-link-container">
            <a class="content-link-confirm" href="">確認画面</a>
        </div>
    </main>
</body>

</html>