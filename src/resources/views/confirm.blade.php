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
                <td class="table-data">{{ $contact['last_name'] . ' ' . $contact['first_name'] }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">性別</th>
                <td class="table-data">{{ $contact['gender']  }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">メールアドレス</th>
                <td class="table-data">{{ $contact['email'] }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">電話番号</th>
                <td class="table-data">{{ $contact['tell']  }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">住所</th>
                <td class="table-data">{{ $contact['address']  }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">建物名</th>
                <td class="table-data">{{ $contact['building']  }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">お問い合わせの種類</th>
                <td class="table-data">{{ $category->content }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-label">お問い合わせ内容</th>
                <td class="table-data">{{ $contact['detail']  }}</td>
            </tr>
        </table>
        <div class="button-container">
            <form class="content-form-submit" action="{{ route('contact.store') }}" method="POST">
            @csrf
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tell-first" value="{{ old('tell-first') }}">
                <input type="hidden" name="tell-second" value="{{ old('tell-second') }}">
                <input type="hidden" name="tell-third" value="{{ old('tell-third') }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] }}">
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                <input class="form-submit-button" type="submit" value="送信">
            </form>
            {{-- お問い合わせフォームに遷移 --}}
            <div>
                <a class="content-link-contact" href="{{ url()->previous() }}">修正</a>
            </div>
        </div>
        
    </main>
</body>

</html>