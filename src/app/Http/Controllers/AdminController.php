<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        // 管理画面ページの表示
        return view('admin');
    }
}
