<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>食品登録</title>
</head>
<body>
    <h1>食品登録</h1>
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
        <br>
            <label>・食品名:</label>
            <input type="text" name="food_name" value="{{ old('food_name') }}" required>
        </div>
        <div>
            <label>・賞味期限:</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}">
        </div>
        <div>
    <label>・保管場所:</label>
    <select name="storage_location">
        <option value="">選択してください</option>
        <option value="冷蔵庫" {{ old('storage_location') == '冷蔵庫' ? 'selected' : '' }}>冷蔵庫</option>
        <option value="冷凍庫" {{ old('storage_location') == '冷凍庫' ? 'selected' : '' }}>冷凍庫</option>
        <option value="常温"   {{ old('storage_location') == '常温' ? 'selected' : '' }}>常温</option>
    </select>
</div>
        <br>
        <button type="submit">登録</button>
        <button type="reset">リセット</button>
        <br><br>
        <a href="{{ route('images.index') }}">一覧に戻る</a>
    </form>
</body>
</hrml>
