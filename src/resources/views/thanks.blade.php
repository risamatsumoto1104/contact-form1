<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanks</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <div class="thanks-container">
        <h2 class="thanks-message">Thank you</h2>
        <p class="thanks-subtext">お問い合わせありがとうございました</p>
        {{-- お問い合わせフォーム入力ページへ遷移 --}}
        <div class="thanks-link-container">
            <a href="" class="thanks-home-link">HOME</a>
        </div>
    </div>
</body>

</html>