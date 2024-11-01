<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
        {{-- ログインページへ遷移 --}}
        <div class="header-link-container">
            <a class="header-link" href="">logout</a>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">admin</h2>
        <form class="content-form" action="">
            <div class="content-form-container-search">
                <div class="form-container-search-group">
                    <input class="form-input-text" type="text" neme="user" placeholder="名前やメールアドレスを入力してください">
                </div>
                <div class="form-container-search-group-select">
                    <select class="form-select-gender">
                        <option value="">性別</option>
                    </select>
                </div>
                <div class="form-container-search-group-select">
                    <select class="form-select-kind">
                        <option value="">お問い合わせの種類</option>
                    </select>
                </div>
                <div class="form-container-search-group">
                    <input class="form-input-calender" type="date" name="calender">
                </div>
                <div class="form-container-search-group">
                    <button class="form-button-search">検索</button>
                </div>
                <div class="form-container-search-group">
                    <button class="form-button-reset">リセット</button>
                </div>
            </div>
            <div class="content-form-container">
                <div class="form-container">
                    <button class="form-button-export">エクスポート</button>
                </div>
                <div class="form-container">
                    <span class="pagination">{{-- ページネーション --}}</span>
                </div>
            </div>
        </form>
        <table class="content-table">
            <tr class="table-row-title">
                <th class="table-label">お名前</th>
                <th class="table-label">性別</th>
                <th class="table-label">メールアドレス</th>
                <th class="table-label">お問い合わせの種類</th>
                <th class="table-label"></th>
            </tr>
            <tr class="table-row-data">
                <td class="table-data">山本  太郎</td>
                <td class="table-data">男性</td>
                <td class="table-data">test@example.com</td>
                <td class="table-data">商品の交換について</td>
                <td class="table-detail-button">
                    <form class="table-form">
                        <button class="table-form-button">詳細</button>
                    </form>
                </td>
            </tr>
        </table>

    </main>
</body>

</html>