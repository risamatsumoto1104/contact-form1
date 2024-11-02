<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    // 登録ページの表示
    public function index(){
        return view('register');
    }

    // 登録処理
    public function store(RegisterRequest $request)
    {
        // バリデーション済みのデータを使用して処理を実行
        $validated = $request->validated();

        // ユーザー登録処理を実行

        // リダイレクトして「ログイン」ページに移動
        return redirect('/login');
    }
    
}
