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
    <header>
        <div>
            <h1>FashionablyLate</h1>
        </div>
    </header>

    <main>
        <h2>Contact</h2>
        <form action="">
            <div>
                <p>お名前</p>
                <input type="text" name="last_name" placeholder="例:山田" >
                <input type="text" name="first_name" placeholder="例:太郎" >
            </div>
            <div>
                <p>性別</p>
                <input type="radio" name="gender">男性
                <input type="radio" name="gender">女性
                <input type="radio" name="gender">その他
            </div>
            <div>
                <p>メールアドレス</p>
                <input type="email" name="email" placeholder="例:test@example.com">
            </div>
            <div>
                <p>電話番号</p>
                <input type="tel" name="tell" placeholder="080">
                <p>-</p>
                <input type="tel" name="tell" placeholder="1234">
                <p>-</p>
                <input type="tel" name="tell" placeholder="5678">
            </div>
            <div>
                <p>住所</p>
                <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" >
            </div>
            <div>
                <p>建物名</p>
                <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" >
            </div>
            <div>
                <p>お問い合わせの種類</p>
                <select>
                    <option value="">選択してください</option>
                </select>
            </div>
            <div>
                <p>お問い合わせ内容</p>
                <textarea name="detail"></textarea>
            </div>
            <div>
                <button>確認画面</button>
            </div>
        </form>
    </main>
</body>

</html>