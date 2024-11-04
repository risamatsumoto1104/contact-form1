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
            $contacts = $query->paginate(7)->appends($request->only(['user', 'gender', 'category_id', 'calendar']));

        } else {
            // 条件がない場合は空のコレクションを返す
            $contacts = collect();
        }

        return view('admin', compact('contacts', 'categories'));
    }

    public function getContactDetails(Request $request) {
        // IDを取得
        $contactId = $request->input('id');

        // 連絡先の詳細を取得
        $contact = Contact::with('category')->find($contactId);

        // データが見つからない場合の処理
        if (!$contact) {
            return response()->json(['error' => 'Contact not found'], 404);
        }

        // データを返す
        return response()->json($contact);
    }

    public function destroy(Request $request)
    {
        Contact::destroy($request->id);

        return redirect('/admin');
    }
}
