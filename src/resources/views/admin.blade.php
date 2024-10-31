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
    <header>
        <div>
            <h1>FashionablyLate</h1>
            {{-- ログインページへ遷移 --}}
            <div>
                <a href="">logout</a>
            </div>
        </div>
    </header>

    <main>
        <h2>admin</h2>
        <form action="">
            <div>
                <input type="text" neme="user" placeholder="名前やメールアドレスを入力してください">
                <select>
                    <option value="">性別</option>
                </select>
                <select>
                    <option value="">お問い合わせの種類</option>
                </select>
                <input type="date" name="calender">
                <div>
                    <button>検索</button>
                </div>
                <div>
                    <button>リセット</button>
                </div>
            </div>
            <div>
                <div>
                    <button>エクスポート</button>
                </div>
                {{-- ページネーション --}}
            </div>
        </form>
        <div>
            <table>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                </tr>
                <tr>
                    <td>山本太郎</td>
                    <td>男性</td>
                    <td>test@example.com</td>
                    <td>商品の交換について</td>
                    <td>
                        <form>
                            <div>
                                <button>詳細</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>