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
            <a class="header-link" href="{{ url('/login') }}">logout</a>
        </div>
    </header>

    <main class="main-content">
        <h2 class="main-content-title">admin</h2>
        <form class="content-form" action="{{ route('admin.search')}}" method="GET">
        {{-- getの為CSRFトークンいらない --}}
            {{-- 1行目 --}}
            <div class="content-form-container-search">
                <div class="form-container-search-group">
                    <input class="form-input-text" type="text" name="user" placeholder="名前やメールアドレスを入力してください">
                </div>

                <div class="form-container-search-group-select">
                    <select class="form-select-gender" name="gender">
                            {{-- デフォルトで表示 --}}
                            <option value="" disabled selected>性別</option>
                            <option value="全て">全て</option>
                            <option value="男性">男性</option>
                            <option value="女性">女性</option>
                            <option value="その他">その他</option>
                    </select>
                </div>

                <div class="form-container-search-group-select">
                    <select class="form-select-kind" name="category_id">
                            {{-- カテゴリのデフォルトで表示 --}}
                            <option value="" disabled selected>選択してください</option>
                            {{-- categoriesテーブルより表示 --}}
                            @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" >{{ $category['content'] }}</option>    
                            @endforeach
                    </select>
                </div>

                <div class="form-container-search-group-calendar">
                    <input class="form-input-calendar" type="date" name="calendar">
                </div>

                <div class="form-container-search-group">
                    <button class="form-button-search">検索</button>
                </div>

                <div class="form-container-search-group">
                    <button class="form-button-reset" type="button" onclick="location.href='{{ url('/admin') }}'">リセット</button>
                </div>
            </div>
            {{-- 2行目 --}}
            <div class="content-form-container">
                <div class="export-container">
                    <button class="form-button-export">エクスポート</button>
                </div>

                {{-- ページネーション --}}
                @if ($contacts->isNotEmpty())
                <div class="pagination">
                    {{-- 前のページへのリンク --}}
                    @if ($contacts->onFirstPage())
                    <span class="pagination-icon disabled"><</span>
                    @else
                    <a class="pagination-icon" href="{{ $contacts->previousPageUrl() }}"><</a>
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
                    <a class="pagination-icon" href="{{ $contacts->nextPageUrl() }}">></a>
                    @else
                    <span class="pagination-icon disabled">></span>
                    @endif
                </div>
                @endif
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
            @foreach ($contacts as $contact)
            <tr class="table-row-data">
                <td class="table-data">{{ $contact->last_name . ' ' . $contact->first_name }}</td>
                <td class="table-data">{{ $contact->gender }}</td>
                <td class="table-data">{{ $contact->email }}</td>
                <td class="table-data">{{ $contact->category->content }}</td>
                <td class="table-detail-button">
                    <form class="table-form" onsubmit="event.preventDefault(); openModal({{ $contact->id }});">
                        <button class="table-form-button" type="submit">詳細</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </main>

    {{-- モーダルウィンドウの構造 --}}
    <div class="modal-content" id="modal">
        {{-- ×ボタン --}}
        <span class="close-button" onclick="closeModel()">&times;</span>
        {{-- モーダルの内容 --}}
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
        {{-- 削除ボタン --}}
        <form class="modal-delete-form" action="{{ url('/admin') }}" method="POST">
        @csrf
        @method('DELETE')
                <div class="form-group">
                    <input type="hidden" name="id" id="modal-id">
                    <button class="delete-button" type="submit">削除</button>
                </div>
        </form>
    </div>
<script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>