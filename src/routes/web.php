<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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


// 管理画面
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin', [AdminController::class, 'search'])->name('admin.search');
Route::post('/admin', [AdminController::class, 'getContactDetails']);
Route::delete('/admin', [AdminController::class, 'destroy']);


// ユーザー登録
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


// ログイン
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);
