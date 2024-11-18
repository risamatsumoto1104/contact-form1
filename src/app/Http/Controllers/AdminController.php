<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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
        return view('admin', compact('contacts', 'categories', 'modalContactId'));
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
        }

        // 性別のラベルを定義
        $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];

        // 検索結果を取得
        $contacts = $query->paginate(7)->appends($request->only(['user', 'gender', 'category_id', 'calendar']));

        // 検索結果の性別を変換
        $contacts->getCollection()->transform(function ($contact) use ($genderLabels) {
            // 数値を対応する性別に変換
            $contact->gender_label = $genderLabels[$contact->gender] ?? '不明';
            return $contact;
        });

        return view('admin', compact('contacts', 'categories'));
    }

    // 特定の連絡先の詳細情報を取得して、モーダルウィンドウに表示する
    public function getContactDetails($id)
    {
        // 特定の連絡先の詳細情報を取得
        $contact = Contact::with('category')->findOrFail($id);

        // 性別のラベルを定義
        $genderLabels = [1 => '男性', 2 => '女性', 3 => 'その他'];

        // 性別のラベルを追加
        $contact->gender_label = $genderLabels[$contact->gender] ?? '不明';

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
        // クエリビルダを初期化
        $query = Contact::query();

        // フィルタリング条件を適用
        $hasFilters = false; // 条件が設定されているかを追跡

        // ユーザー名またはメールでフィルタリング
        if ($request->filled('user')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->user . '%')
                    ->orWhere('first_name', 'like', '%' . $request->user . '%')
                    ->orWhere('email', 'like', '%' . $request->user . '%');
            });
            $hasFilters = true;
        }

        // 性別でフィルタリング（条件が「全て」または未指定ならスキップ）
        if ($request->filled('gender') && $request->gender !== '全て' && $request->gender !== 'All') {
            $query->where('gender', $request->gender);
            $hasFilters = true;
        }

        // カテゴリーでフィルタリング（条件が未指定ならスキップ）
        if ($request->filled('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
            $hasFilters = true;
        }

        // 日付でフィルタリング（条件が未指定ならスキップ）
        if ($request->filled('calendar')) {
            $query->whereDate('created_at', $request->calendar);
            $hasFilters = true;
        }

        // 条件が一切設定されていない場合は全件取得
        if ($hasFilters) {
            $contacts = $query->get(); // フィルタリングされた結果を取得
        } else {
            $contacts = Contact::all(); // 全件取得
        }

        // データが空でないかを確認
        if ($contacts->isEmpty()) {
            // フィルタリングがかかっていてデータがない場合にのみエラーメッセージ
            if ($hasFilters) {
                return back()->with('error', '該当するデータがありません。');
            }
        }

        // CSVの作成
        $csvFileName = 'contacts_' . date('Ymd') . '.csv';
        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

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
                optional($contact->category)->content, // カテゴリーが存在しない場合の対応
                $contact['detail'],
            ]);
        }

        return response()->stream(function () use ($handle) {
            fclose($handle);
        }, 200, $headers);
    }
}
