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

        <form class="content-form" action="{{ url('/confirm') }}" method="POST">
        @csrf
            <div class="content-form-group">
                <p class="content-form-label-required">お名前</p>
                <div class="content-form-inner-name">
                    <input class="form-input-name" type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') ?? session('contact_data.last_name')}}" >
                    <input class="form-input-name"  type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') ?? session('contact_data.first_name')}}" >
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('last_name')
                <span class="error-message">{{ $message }}</span>
                @enderror
                @error('first_name')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="content-form-group">
                <p class="content-form-label-required">性別</p>
                <div class="content-form-inner-radio">
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender" value="男性">男性</label>
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender" value="女性">女性</label>
                    <label class="label-radio"><input class="form-input-radio" type="radio" name="gender" value="その他">その他</label>
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('gender')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>


            <div class="content-form-group">
                <p class="content-form-label-required">メールアドレス</p>
                <div class="content-form-inner">
                    <input class="form-input" type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') ?? session('contact_data.email') }}" >
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="content-form-group">
                <p class="content-form-label-required">電話番号</p>
                <div class="content-form-inner-tel">
                    <input class="form-input-tel" type="tel" name="tell-first" placeholder="080" value="{{ old('tell-first') ?? session('contact_data.tell-first') }}" >
                    <p class="tel-hyphen">-</p>
                    <input class="form-input-tel" type="tel" name="tell-second" placeholder="1234" value="{{ old('tell-second') ?? session('contact_data.tell-second') }}" >
                    <p class="tel-hyphen">-</p>
                    <input class="form-input-tel" type="tel" name="tell-third" placeholder="5678" value="{{ old('tell-third') ?? session('contact_data.tell-third') }}" >
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('tell-first')
                <span class="error-message">{{ $message }}</span>
                @enderror
                @error('tell-second')
                <span class="error-message">{{ $message }}</span>
                @enderror
                @error('tell-third')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>


            <div class="content-form-group">
                <p class="content-form-label-required">住所</p>
                <div class="content-form-inner">
                    <input class="form-input" type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') ?? session('contact_data.address') }}" >
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('address')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="content-form-group">
                <p class="content-form-label">建物名</p>
                <div class="content-form-inner">
                    <input class="form-input" type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') ?? session('contact_data.building') }}" >
                </div>
            </div>

            <div class="content-form-group">
                <p class="content-form-label-required">お問い合わせの種類</p>
                <div class="content-form-inner-select">
                    <span class="span-form-select">
                        <select class="form-select" name="category_id">
                            {{-- カテゴリのデフォルトで表示 --}}
                            <option value="" disabled selected>選択してください</option>
                            {{-- categoriesテーブルより表示 --}}
                            @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" >{{ $category['content'] }}</option>    
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            {{-- エラーメッセージの表示 --}}
            <div class="error-group">
                @error('category_id')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="content-form-group">
                <p class="content-form-label-required">お問い合わせ内容</p>
                <textarea class="form-textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') ?? session('contact_data.detail') }}</textarea>
            </div>
            {{-- エラーメッセージの表示 --}} 
            <div class="error-group">
                @error('detail')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- 確認画面ページへ遷移 --}}
            <div class="content-button-container">
                <button class="content-button-confirm" type="submit">確認画面</button>
            </div>
        </form>
    </main>
</body>

</html>