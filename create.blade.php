<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Food-expiry-tracker-App – 新規登録</title>
</head>
<body>
    <h1>Food-expiry-tracker-App – 新規登録</h1>
    {{-- バリデーションエラー表示--}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('images.store') }}" method="post">
        @csrf
        <div>
            <label>食品名:</label>
            <input type="text" name="food_name" value="{{ old('food_name') }}" required>
        </div>
        <div>
            <label>賞味期限:</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}">
        </div>
        <div>
            <label>保管場所:</label>
            <input type="text" name="storage_location" value="{{ old('storage_location') }}">
        </div>
        <button type="submit">登録</button>
        <a href="{{ route('images.index') }}">一覧に戻る</a>
    </form>
</body>
</hrml>
