<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

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

        // ユーザー登録処理を実行

        // リダイレクトして「管理画面」ページに移動
        return redirect('/admin');
    }
}
