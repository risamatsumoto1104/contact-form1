<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ConfirmController extends Controller
{
    // お問い合わせ確認ページの表示
    public function confirm(ContactRequest $request)
    {
        // 入力したデータををすべてセッションに保存
        $request->session()->put('contact_data', $request->all());

        // 姓名と電話番号を結合
        $contact = [
            'full_name' => $request->input('last_name') . ' ' . $request->input('first_name'),
            'tell' => $request->input('tell-first') . '-' . $request->input('tell-second') . '-' . $request->input('tell-third')
        ];

        // category_idに対応するカテゴリーの名前を取得して追加
        $contact['category_name'] = Category::where('id', $request->input('category_id'))->pluck('name')->first();

        // confirmに渡す値の指定(他の項目も含めて$contact配列に追加)
        $contact += $request->only(['gender','email','address','building','detail']);

        // contactのデータがビューに渡され、confirmビュー内で$contactとして利用できるようになる
        return view('confirm', compact('contact'));
    }


    // データベースにお問い合わせ内容を保存
    public function store(ContactRequest $request)
    {
        // バリデーション済みのデータを使用して処理を実行
        $validated = $request->validated();

        // 電話番号を結合して一つのデータにする
        $tell = $validated['tell-first'] . '-' . $validated['tell-second'] . '-' . $validated['tell-third'];

        // お問い合わせ作成(保存)
        $contact = Contact::create([
            'category_id' => $validated['category_id'], 
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'tell' => $tell,
            'address' => $validated['address'],
            'building' => $validated['building'],
            'detail' => $validated['detail']
        ]);

        // リダイレクトして「thanks」ページに移動
        return redirect('/thanks');
    }

    // 修正ボタンで入力フォームに戻る
    public function back(Request $request)
    {
        // 以前の入力データを保持したままリダイレクト
        return redirect()->back()->withInput();
    }
}
