<?php

namespace App\Http\Controllers;
use App\Models\FoodImage;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    // 通知ページ
    public function note(Request $request)
    {
        $today = Carbon::today();

        $foods = FoodImage::whereNotNull('expiration_date')
            ->get()
            ->map(function ($food) use ($today) {
                $food->days_left = $today->diffInDays(
                    Carbon::parse($food->expiration_date),
                    false
                );

                $food->storage_location = $food->storage_location ?: '未設定';

                return $food;
            });

        if ($request->get('sort') === 'expiry') {
            // 全体を賞味期限順
            $foods = $foods->sortBy('days_left');
        } else {
            // 保管場所ごと
            $foods = $foods
                ->groupBy('storage_location')
                ->map(fn ($group) => $group->sortBy('days_left'));
        }

        return view('food_images.note', compact('foods'));
    }
    // 期限切れ食品を削除
    public function note_delete(FoodImage $image)
    {
        $image->delete();

        return redirect()->route('images.note')
            ->with('success', '期限切れ食品を削除しました。');
    }
    
    // 削除画面表示(適宜変更してください)
    public function delete(FoodImage $foodImage)
    {
        return view('food_images.delete', compact('foodImage'));
    }
}
