<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 管理画面の表示
    public function index()
    {
        // 初期表示時は空のコレクションを渡す
        $contacts = collect();

        // カテゴリーデータの取得
        $categories = Category::all();

        // 初期値としてnullを設定
        $modalContactId = null;

        // 管理画面ページの表示
        return view('admin',compact('contacts', 'categories', 'modalContactId'));
    }

    // 検索機能
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

    // 特定の連絡先の詳細情報を取得して、モーダルウィンドウに表示する
    public function getContactDetails($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    // 削除機能
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/admin');
    }

    // エクスポート
    public function exportToCSV(Request $request)
    {
        // 検索条件を取得（必要に応じてフィルタリングの実装を行う）
        $query = Contact::query();

        if ($request->filled('user')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->user . '%')
                ->orWhere('first_name', 'like', '%' . $request->user . '%')
                ->orWhere('email', 'like', '%' . $request->user . '%');
            });
        }

        // genderが'All'でない場合はフィルタリング
        if ($request->filled('gender') && $request->gender !== 'All') {
            $query->where('gender', $request->gender);
        }

        // カテゴリーが設定されている場合
        if ($request->filled('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('calendar')) {
            $query->whereDate('created_at', $request->calendar);
        }

        // フィルタリングされた結果を取得
        $contacts = $query->get();

        // CSVの作成
        $csvFileName = 'contacts_' . date('Ymd') . '.csv';
        $headers = array(
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $handle = fopen('php://output', 'w');
        // UTF-8 BOMの追加（Excelでの文字化け防止）
        fwrite($handle, "\xEF\xBB\xBF");
        
        // ヘッダー行
        fputcsv($handle, ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact['last_name'] . ' ' . $contact['first_name'],
                $contact['gender'],
                $contact['email'],
                $contact['tell'],
                $contact['address'],
                $contact['building'],
                $contact->category->content,
                $contact['detail']
            ]);
        }

        return response()->stream(function() use ($handle) {
            fclose($handle);
        }, 200, $headers);
    }
}
