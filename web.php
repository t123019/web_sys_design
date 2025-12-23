<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodImageController;   // ← 追加
Route::get('/', function () {
    return view('welcome');
});
//JSON用
Route::get('/images/json', [FoodImageController::class, 'indexJson'])->name('images.json');
//一覧表示
Route::get('/images', [FoodImageController::class, 'index'])->name('images.index');
//新規作成フォーム表示
Route::get('/images/create', [FoodImageController::class, 'create'])->name('images.create');
//新規作成のPOST受付
Route::post('/images', [FoodImageController::class, 'store'])->name('images.store');
//通知一覧
Route::get('/images/note', [FoodImageController::class, 'note'])->name('images.note');
// 編集ページ
Route::get('/images/edit', [FoodImageController::class, 'edit'])->name('images.edit');
// 削除確認ページ用
Route::get('/images/delete', [FoodImageController::class, 'delete'])->name('images.delete');
// 通知削除
Route::delete('/images/{image}', [FoodImageController::class, 'note_delete'])->name('images.note_delete');

// 新しいルートはこの上に書いてください
//ルートを自動生成
Route::resource('food-images', FoodImageController::class);
