<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ThanksController;

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

// お問い合わせフォーム入力ページ
Route::get('/', [ContactController::class, 'index']);
// お問い合わせフォーム確認ページ 
Route::get('/confirm', [ConfirmController::class, 'index']);
// サンクスページ
Route::get('/thanks', [ThanksController::class, 'index']);
// 管理画面
Route::get('/admin', [AdminController::class, 'index']);
// ユーザー登録ページ
Route::get('/register', [RegisterController::class, 'index']);
// ログインページ
Route::get('/login', [LoginController::class, 'index']);
