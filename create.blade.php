<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食品登録</title>

    <style>
        /* 全体 */
        body {
            font-family: "Segoe UI", "Hiragino Kaku Gothic ProN", sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 24px;
        }

        h1 {
            margin-bottom: 16px;
        }

        /* コンテナ */
        .container {
            background: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: auto;
        }

        /* エラーメッセージ */
        .error {
            background: #fdecea;
            border-left: 6px solid #f44336;
            padding: 12px;
            margin-bottom: 16px;
            color: #b71c1c;
        }

        /* フォーム */
        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* ボタン */
        .btn2 {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.95em;
            cursor: pointer;
            border: none;
        }

        .btn2.primary {
            background: #4CAF50;
            color: white;
        }
        .btn2.primary:hover {
            background: #43a047;
        }

        .btn2.reset {
            background: #eee;
            color: #333;
            border: 1px solid #ccc;
        }
        .btn2.reset:hover {
            background: #ddd;
        }

        .btn2.link {
            background: #eee;
            color: #333;
            border: 1px solid #ccc;
        }
        .btn2.link:hover {
            text-decoration: underline;
        }

        .actions {
            margin-top: 24px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>食品登録</h1>

    {{-- バリデーションエラー表示 --}}
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('images.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>食品名</label>
            <input type="text" name="food_name" value="{{ old('food_name') }}" required>
        </div>

        <div class="form-group">
            <label>賞味期限</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}">
        </div>

        <div class="form-group">
            <label>保管場所</label>
            <select name="storage_location">
                <option value="">選択してください</option>
                <option value="冷蔵庫" {{ old('storage_location') == '冷蔵庫' ? 'selected' : '' }}>冷蔵庫</option>
                <option value="冷凍庫" {{ old('storage_location') == '冷凍庫' ? 'selected' : '' }}>冷凍庫</option>
                <option value="常温"   {{ old('storage_location') == '常温' ? 'selected' : '' }}>常温</option>
            </select>
        </div>

        <div class="actions">
            <button type="submit" class="btn2 primary">登録</button>
            <button type="reset" class="btn2 reset">リセット</button><br><br><br>
            <a href="{{ route('images.index') }}" class="btn2 link">戻る</a>
        </div>
    </form>
</div>

</body>
</html>
