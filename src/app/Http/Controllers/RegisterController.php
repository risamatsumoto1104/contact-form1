<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    // 登録ページの表示
    public function index()
    {
        return view('register');
    }

    // データベースにユーザー情報を保存
    public function store(RegisterRequest $request)
    {
        // 「validated」変数はバリデーション後のデータが格納されている
        $validated = $request->validated();

        // ユーザー作成
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        // リダイレクトして「ログイン」ページに移動
        return redirect('/login');
    }
}
