<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // お問い合わせ入力フォーム表示
    public function index()
    {
        // カテゴリーデータの取得
        $categories = Category::all();

        // contactsとcategoriesのデータがビューに渡され、contactビュー内で$contactsや$categoriesとして利用できるようになる
        return view('contact',compact('categories'));
    }


    // お問い合わせ確認ページの表示
    public function confirm(ContactRequest $request)
    {
        // リクエストデータからcontact情報を作成
        $contact = $request->only(['gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['full_name'] = $request->input('last_name') . ' ' . $request->input('first_name');
        $contact['tell'] = $request->input('tell-first') . '-' . $request->input('tell-second') . '-' . $request->input('tell-third');

        // フラッシュデータにリクエストデータを保存
        $request->flash();

        // categoryデータの取得
        $categories = Category::all();

        // contactのデータがビューに渡され、confirmビュー内で$contactとして利用できるようになる
        return view('confirm', compact('contact', 'categories'));
    }


    // データベースにお問い合わせ内容を保存
    public function store(ContactRequest $request)
    {   
        $contact = $request->all();
        dd($contact);

        Contact::create($contact);

        // 「thanks」ページに移動
        return view('thanks');
    }

}
