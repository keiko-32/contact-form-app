<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\Request;

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
    // バリデーション・確認画面へリダイレクト
    public function confirm(StoreContactRequest $request)
    {

        // 検証済みの値を変数に代入する
        $validated = $request->validated();
        //バリデーション済みデータをセッションに保存
        $request->session()->put('contact_input', $request->validated());

        return redirect()->route('contact.showConfirm');
    }

    // 確認画面の表示
    public function showConfirm(Request $request)
    {
        // セッションからデータを取得（なければ入力画面へ）
        $validated = $request->session()->get('contact_input');
        if (!$validated) {
            return redirect()->route('contact.index');
        }

        //　カテゴリ名とタグ名を取得してビューに渡す
        $category = Category::find($validated['category_id']);
        // 複数選択を想定
        $tags = isset($validated['tag_ids']) ? Tag::whereIn('id', $validated['tag_ids'])->get() : collect();

        return view('contact.confirm', compact('validated', 'category', 'tags'));
    }

// 送信処理
public function send(Request $request)
    {
        $validated = $request->session()->get('contact_input');
        if ($validated) {
            return redirect()->route('contact.thanks');
        }
        // 修正ボタンが押された時
        if ($request->has('back')) {
            //入力画面へ戻る
            return redirect()->route('contact.index')->withInput($validated);
        }

        // セッションをクリア
        $request->session()->forget('contact_input');
        return redirect()->route('contact.thanks');

    }
    // 完了画面の表示
    public function thanks()
    {
        return view('contact.thanks');
    }

}

