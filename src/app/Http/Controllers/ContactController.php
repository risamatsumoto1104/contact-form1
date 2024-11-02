<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function store(ContactRequest $request)
    {
        // バリデーション済みのデータを使用して処理を実行
        $validated = $request->validated();

        return redirect('contact');
    }

    public function confirm(ContactRequest $request)
    {
        return view('confirm');
    }
}
