<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // ログインページの表示
    public function index(){
        return view('login');
    }

    // ログイン処理
    public function store(LoginRequest $request)
    {
        // バリデーション済みのデータを使用して処理を実行
        $validated = $request->validated();

        // ユーザーが入力したメールアドレスとパスワードで認証を試みる
        if(Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])){
            // 成功　セッションを再生成して、セキュリティを向上
            $request->session()->regenerate();
        }else{
            // 失敗　ログインページに戻る
            return back()->withErrors([
                'email' => 'メールアドレスが違うか、登録されていません。',
                'password' => 'パスワードが違うか、登録されていません。'
            ]);
        }


        // リダイレクトして「管理画面」ページに移動
        return redirect('/admin');
    }
}
