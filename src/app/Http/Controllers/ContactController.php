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

        // カテゴリーデータをcontactビューに渡す
        return view('contact',compact('categories'));
    }


    // お問い合わせ確認ページの表示
    public function confirm(ContactRequest $request)
    {
        // リクエストデータからcontact情報を取得
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        // リクエストデータから電話番号を結合し、'tell'に格納
        $contact['tell'] = $request->input('tell-first'). '-'. $request->input('tell-second'). '-'.  $request->input('tell-third');

        // フラッシュデータにリクエストデータを保存
        $request->flashOnly([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tell-first',
            'tell-second',
            'tell-third',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        // 選択されたカテゴリーデータを取得
        $category = Category::find($contact['category_id']);

        // contactとcategoryのデータをconfirmビューに渡す
        return view('confirm', compact('contact', 'category'));
    }


    // データベースにお問い合わせ内容を保存
    public function store(Request $request)
    {   
        // リクエストデータからcontact（入力データ）を取得
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        // リクエストデータから電話番号を結合し、'tell'に格納
        $contact['tell'] = $request->input('tell-first'). $request->input('tell-second'). $request->input('tell-third');

        // データベースに新しいcontactを保存
        Contact::create($contact);

        // thanksルートにリダイレクトして、完了メッセージを表示
        return redirect()->route('thanks');
    }

}
