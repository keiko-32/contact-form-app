<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームを表示
     */
    public function index()
    {
        // 選択肢用のデータを全件取得
        $categories = Category::all();
        $tags = Tag::all();

        // 取得したデータを入力画面のビューに渡す
        return view('contact.index', compact('categories', 'tags'));

    }

    public function create()
    {
        // FormRequestで検証済みのデータを取得
        $validated = $request->validated();
        // 確認画面で入力されたデータを表示するために、セッションに保存
    }
}
