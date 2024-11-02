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
        // Contactモデルのレコードと、それに紐付くcategoryテーブルのレコードを取得
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        // contactsとcategoriesのデータがビューに渡され、contactビュー内で$contactsや$categoriesとして利用できるようになる
        return view('contact',compact('contacts', 'categories'));
    }

    // バリデーションエラーがなければ確認画面へ遷移
    public function confirm(ContactRequest $request)
    {
        // confirmに渡す値の指定
        $contact = [
            'full_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'category_id' => $request->input('category_id'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tell' => $request->input('tell-first') . '-' . $request->input('tell-second') . '-' . $request->input('tell-third'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'detail' => $request->input('detail')
        ];

        // contactのデータがビューに渡され、confirmビュー内で$contactとして利用できるようになる
        return view('confirm', compact('contact'));
    }
}
