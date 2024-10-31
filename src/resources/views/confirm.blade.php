<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comfirm.css') }}">
</head>

<body>
    <header>
        <div>
            <h1>FashionablyLate</h1>
        </div>
    </header>

    <main>
        <h2>Confirm</h2>
        <table>
            <tr>
                <th>お名前</th>
                <td>山田 太郎</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>男性</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>test@example.com</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>08012345678</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>東京都渋谷区千駄ヶ谷1-2-3</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>千駄ヶ谷マンション101</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>商品の交換について</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>届いた商品が注文した商品ではありませんでした。<br>
                商品の取替をお願いします。</td>
            </tr>
        </table>
        <form action="">
            <div>
                <input type="submit" value="送信">
            </div>
        </form>
        {{-- お問い合わせフォームに遷移 --}}
        <div>
            <a href="">修正</a>
        </div>
    </main>
</body>

</html>