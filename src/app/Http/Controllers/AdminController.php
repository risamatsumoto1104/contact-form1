<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        // 初期表示時は空のコレクションを渡す
        $contacts = collect();

        // カテゴリーデータの取得
        $categories = Category::all();

        // 管理画面ページの表示
        return view('admin',compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        // Contactモデルに基づくクエリビルダを作成
        $query = Contact::query();

        // カテゴリーデータの取得
        $categories = Category::all();

        // 検索条件が指定されている場合のみデータを取得
        if ($request->filled('user') || $request->filled('gender') || $request->filled('category_id') || $request->filled('calendar')) {
            $query = $query
            ->userSearch($request->input('user'))
            ->genderSearch($request->input('gender'))
            ->categorySearch($request->input('category_id'))
            ->dateSearch($request->input('calendar'));

            // 検索結果を取得
            $contacts = $query->paginate(7)->appends([
                'user' => $request->input('user'),
                'gender' => $request->input('gender'),
                'category_id' => $request->input('category_id'),
                'calendar' => $request->input('calendar')
            ]);

        } else {
            // 条件がない場合は空のコレクションを返す
            $contacts = collect();
        }

        return view('admin', compact('contacts', 'categories'));
    }
}
