<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 入力
Route::get('/', [ContactController::class, 'index']);
// 確認
Route::post('/confirm', [ContactController::class, 'confirm']);
// 保存
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
// 完了
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

// 認証済みユーザー専用ルート
Route::middleware('auth')->group(
    function () {
        // 管理画面
        Route::get('/admin', [AdminController::class, 'index']);
        // 検索機能（getが重複する為、ルートパスを変更する）
        Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
        // 詳細の取得（idをパラメータに指定）
        Route::get('/admin/contact/{id}', [AdminController::class, 'getContactDetails'])->name('admin.contact.details');
        // 削除（idをパラメータに指定））
        Route::delete('/admin/contact/{id}', [AdminController::class, 'destroy'])->name('admin.contact');
        // エクスポート
        Route::get('/admin/export', [AdminController::class, 'exportToCSV'])->name('admin.export');
        // ログアウト
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    }
);

// 未認証ユーザー専用ルート
Route::middleware('guest')->group(
    function () {
        // ユーザー登録
        Route::get('/register', [RegisterController::class, 'index']);
        Route::post('/register', [RegisterController::class, 'store']);

        // ログイン
        Route::get('/login', [LoginController::class, 'index']);
        Route::post('/login', [LoginController::class, 'store']);
    }
);
