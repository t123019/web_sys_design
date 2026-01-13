<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>食品削除確認ページ</title>
        <style>
        /* 全体 */
        body {
            font-family: "Segoe UI", "Hiragino Kaku Gothic ProN", sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 24px;
        }

        h1 {
            margin-bottom: 8px;
        }

        h2 {
            margin-top: 24px;
            margin-bottom: 8px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            max-width: 900px;
            margin: auto;
        }

        /* ボタン(1)  ※今回は使わないけどそのまま置いてOK */
        .menu {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn1 {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #eee;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .btn1:hover {
            background: #ddd;
        }

        .btn1.primary {
            background: #4CAF50;
            color: white;
            border: none;
        }

        .btn1.primary:hover {
            background: #43a047;
        }

        /* ボタン(2) */
        .btn2 {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 4px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9em;
            cursor: pointer;
            border: none;
        }

        /* 編集(=キャンセル用の青) */
        .btn2.edit {
            background: #2196F3;
            color: white;
        }
        .btn2.edit:hover {
            background: #1976D2;
        }

        /* 削除(赤) */
        .btn2.danger {
            background: #f44336;
            color: white;
        }
        .btn2.danger:hover {
            background: #d32f2f;
        }

        /* 注意文 */
        .warning {
            background: #fff3e0;
            border-left: 6px solid #fb8c00;
            padding: 10px;
            margin-bottom: 16px;
            color: #e65100;
        }

        /* リスト */
        ul.info-list {
            list-style: none;
            padding-left: 0;
        }

        ul.info-list li {
            margin-bottom: 4px;
        }
    </style>
    </head>
    <body>
    <div class="container">
        <h1>Food-expiry-tracker-App</h1>
        <h2>食品削除確認 #{{ $foodImage->id }}</h2>

        <p class="warning">
            以下の食品情報を削除します。<br>
            本当によろしいですか？
        </p>

        <ul class="info-list">
            <li>食品名：{{ $foodImage->food_name }}</li>
            <li>
                賞味期限：
                {{ $foodImage->expiration_date
                    ? \Carbon\Carbon::parse($foodImage->expiration_date)->format('Y年n月j日')
                    : '未設定' }}
            </li>
            <li>保管場所：{{ $foodImage->storage_location }}</li>
        </ul>

        <form method="POST" action="{{ route('food-images.destroy', $foodImage) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn2 danger">削除する</button>
        </form>

        <form method="GET" action="{{ route('images.index') }}" style="display:inline;">
            <button type="submit" class="btn2 edit">キャンセル</button>
        </form>
    </div>
    </body>
</html>
