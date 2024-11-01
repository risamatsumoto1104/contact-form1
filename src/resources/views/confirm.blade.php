<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">Confirm</h2>
        <table class="content-table">
            <tr class="table-row">
                <th class="table-label">お名前</th>
                <td class="table-data">山田 太郎</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">性別</th>
                <td class="table-data">男性</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">メールアドレス</th>
                <td class="table-data">test@example.com</td>
            </tr class="table-row">
            <tr class="table-row">
                <th class="table-label">電話番号</th>
                <td class="table-data">08012345678</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">住所</th>
                <td class="table-data">東京都渋谷区千駄ヶ谷1-2-3</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">建物名</th>
                <td class="table-data">千駄ヶ谷マンション101</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">お問い合わせの種類</th>
                <td class="table-data">商品の交換について</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">お問い合わせ内容</th>
                <td class="table-data">届いた商品が注文した商品ではありませんでした。<br>
                商品の取替をお願いします。</td>
            </tr>
        </table>
        <div class="button-container">
            <form class="content-form-submit" action="">
                <input class="form-submit-button" type="submit" value="送信">
            </form>
            {{-- お問い合わせフォームに遷移 --}}
            <a class="content-link-contact" href="">修正</a>
        </div>
        
    </main>
</body>

</html>