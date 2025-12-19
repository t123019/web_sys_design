<?php

namespace App\Http\Controllers;
use App\Models\FoodImage;
use Illuminate\Http\Request;

class FoodImageController extends Controller
{
    // JSON 用
    public function indexJson() //※元のindex関数->indexJson()に
    {
        return FoodImage::all();
    }
    // HTML 用（View）
    public function index()
    {
        $images = FoodImage::all();
        return view('food_images.index', compact('images'));
    }
     // ★ 新規作成フォーム表示
    public function create()
    {
        return view('food_images.create');
    }
    // ★ フォームから送られてきたデータを保存
    public function store(Request $request)
    {
        // 簡単なバリデーション
        $data = $request->validate([
            'food_name'            => 'required|string|max:255',
            'expiration_date'      => 'nullable|date',
            'storage_location'     => 'nullable|string|max:255',
        ]);
        FoodImage::create($data);
        // 登録後、一覧にリダイレクト
        return redirect()->route('images.index')
                         ->with('success', '新しいレコードを追加しました。');
    }
    //更新画面表示
    public function edit(FoodImage $foodImage)
    {
        return view('food_images.edit', compact('foodImage'));
    }
    //更新
    public function update(Request $request, FoodImage $foodImage)
    {
        $data = $request->validate([
            'food_name'            => 'required|string|max:255',
            'expiration_date'      => 'nullable|date',
            'storage_location'     => 'nullable|string|max:255',
        ]);
        $foodImage->update($data);
        return redirect()->route('images.index')
                         ->with('success','Updated successfully');
    }
}
