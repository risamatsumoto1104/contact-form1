<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
        {{-- ログインページへ遷移 --}}
        <div class="header-link-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="header-link" type="submit">logout</button>
            </form>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">admin</h2>
        <form class="content-form" action="{{ route('admin.search') }}" method="GET">
            {{-- getの為CSRFトークンいらない --}}
            {{-- 1行目 --}}
            <div class="content-form-container-search">
                <div class="form-container-search-group">
                    <input class="form-input-text" type="text" name="user" placeholder="名前やメールアドレスを入力してください"
                        value="{{ old('user', request()->input('user')) }}">
                </div>

                <div class="form-container-search-group-select">
                    <select class="form-select-gender" name="gender">
                        {{-- デフォルトで表示 --}}
                        <option value="" disabled selected>性別</option>
                        <option value="全て"
                            {{ old('gender', request()->input('gender')) == 'All' ? 'selected' : '' }}>全て</option>
                        <option value="男性" {{ old('gender', request()->input('gender')) == '1' ? 'selected' : '' }}>
                            男性</option>
                        <option value="女性" {{ old('gender', request()->input('gender')) == '2' ? 'selected' : '' }}>
                            女性</option>
                        <option value="その他" {{ old('gender', request()->input('gender')) == '3' ? 'selected' : '' }}>
                            その他</option>
                    </select>
                </div>

                <div class="form-container-search-group-select">
                    <select class="form-select-kind" name="category_id">
                        {{-- カテゴリのデフォルトで表示 --}}
                        <option value="" disabled selected>選択してください</option>
                        {{-- categoriesテーブルより表示 --}}
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', request()->input('category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-container-search-group-calendar">
                    <input class="form-input-calendar" type="date" name="calendar"
                        value="{{ old('calendar', request()->input('calendar')) }}">
                </div>

                <div class="form-container-search-group">
                    <button class="form-button-search">検索</button>
                </div>

                <div class="form-container-search-group">
                    <button class="form-button-reset" type="button"
                        onclick="location.href='{{ url('/admin') }}'">リセット</button>
                </div>
            </div>
        </form>

        {{-- 2行目 --}}
        <div class="content-form-container">
            {{-- エクスポート --}}
            <div class="export-container">
                <form action="{{ route('admin.export') }}" method="GET">
                    {{-- getの為CSRFトークンいらない --}}
                    <input type="hidden" name="user" value="{{ request('user') }}">
                    <input type="hidden" name="gender" value="{{ request('gender', 'All') }}">
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    <input type="hidden" name="calendar" value="{{ request('calendar') }}">
                    <button class="form-button-export" type="submit">エクスポート</button>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>

            {{-- ページネーション --}}
            @if ($contacts->isNotEmpty())
                <div class="pagination">
                    {{-- 前のページへのリンク --}}
                    @if ($contacts->onFirstPage())
                        <span class="pagination-icon disabled">&lt;</span>
                    @else
                        <a class="pagination-icon" href="{{ $contacts->previousPageUrl() }}">&lt;</a>
                    @endif

                    {{-- ページ番号リンク --}}
                    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                        @if ($i == $contacts->currentPage())
                            <span class="pagination-icon active">{{ $i }}</span>
                        @else
                            <a class="pagination-icon" href="{{ $contacts->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- 次のページへのリンク --}}
                    @if ($contacts->hasMorePages())
                        <a class="pagination-icon" href="{{ $contacts->nextPageUrl() }}">&gt;</a>
                    @else
                        <span class="pagination-icon disabled">&gt;</span>
                    @endif
                </div>
            @endif
        </div>

        <table class="content-table">
            <tr class="table-row-title">
                <th class="table-label">お名前</th>
                <th class="table-label">性別</th>
                <th class="table-label">メールアドレス</th>
                <th class="table-label">お問い合わせの種類</th>
                <th class="table-label"></th>
            </tr>
            @foreach ($contacts as $contact)
                <tr class="table-row-data">
                    <td class="table-data">{{ $contact->last_name . ' ' . $contact->first_name }}</td>
                    <td class="table-data">{{ $contact->gender_label }}</td>
                    <td class="table-data">{{ $contact->email }}</td>
                    <td class="table-data">{{ $contact->category->content }}</td>
                    <td class="table-detail-button">
                        {{-- ボタンを押すとモーダルウィンドウが開く --}}
                        <button class="table-form-button" type="button"
                            onclick="showDetails({{ $contact->id }})">詳細</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>

    {{-- モーダルウィンドウの構造 --}}
    <div class="modal-content" id="modal">
        {{-- ×ボタン --}}
        <div class="modal-close-button-container">
            <span class="close-button">&times;</span>
        </div>
        {{-- モーダルの内容 --}}
        <div class="modal-content-container">
            <table class="modal-content-table">
                <tr class="modal-table-row">
                    <th class="modal-table-label">お名前</th>
                    <td class="modal-table-data" id="modal-name">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">性別</th>
                    <td class="modal-table-data" id="modal-gender">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">メールアドレス</th>
                    <td class="modal-table-data" id="modal-email">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">電話番号</th>
                    <td class="modal-table-data" id="modal-tell">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">住所</th>
                    <td class="modal-table-data" id="modal-address">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">建物名</th>
                    <td class="modal-table-data" id="modal-building">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">お問い合わせの種類</th>
                    <td class="modal-table-data" id="modal-category">データ</td>
                </tr>
                <tr class="modal-table-row">
                    <th class="modal-table-label">お問い合わせ内容</th>
                    <td class="modal-table-data" id="modal-detail">データ</td>
                </tr>
            </table>
        </div>
        {{-- 削除ボタン --}}
        <div class="modal-delete-button-container">
            <form class="modal-delete-form" id="delete-contact-form" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="modal-id">
                <button class="delete-button" type="submit">削除</button>
            </form>
        </div>
    </div>

    {{-- モーダルウィンドウを表示するためのJavaScript --}}
    <script>
        function showDetails(contactId) {
            // fetchを使って指定されたcontactIdの詳細情報を取得
            fetch(`/admin/contact/${contactId}`)
                // レスポンスをJSON形式で解析
                .then(response => response.json())
                .then(data => {
                    // 性別のラベルを定義
                    const genderLabels = {
                        1: '男性',
                        2: '女性',
                        3: 'その他'
                    };

                    // モーダルの各要素にデータを設定
                    document.getElementById('modal-name').innerText = data.last_name + ' ' + data.first_name;
                    document.getElementById('modal-gender').innerText = genderLabels[data.gender] ||
                        '不明'; // genderを数値からラベルに変換して表示
                    document.getElementById('modal-email').innerText = data.email;
                    document.getElementById('modal-tell').innerText = data.tell;
                    document.getElementById('modal-address').innerText = data.address;
                    document.getElementById('modal-building').innerText = data.building;
                    document.getElementById('modal-category').innerText = data.category.content;
                    document.getElementById('modal-detail').innerText = data.detail;

                    // モーダルを開く際にIDを設定
                    document.getElementById('modal-id').value = data.id;

                    // 削除フォームのactionを設定
                    document.getElementById('delete-contact-form').action = `/admin/contact/${data.id}`;

                    // モーダルを表示
                    document.getElementById('modal').style.display = 'block';
                })
                .catch(error => console.error('Error fetching contact details:', error));
        }

        document.querySelector('.close-button').onclick = function() {
            // モーダルを閉じる
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>

</html>
