<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food-expiry-tracker-App (一覧表示)</title>
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
            margin-top: 32px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            max-width: 900px;
            margin: auto;
        }

        /* ボタン(1) */
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

        /* テーブル */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #333;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
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
        }

        /* 編集 */
        .btn2.edit {
            background: #2196F3;
            color: white;
        }
        .btn2.edit:hover {
            background: #1976D2;
        }

        /* 削除 */
        .btn2.danger {
            background: #f44336;
            color: white;
        }
        .btn2.danger:hover {
            background: #d32f2f;
        }

        /* 成功メッセージ */
        .success {
            background: #e8f5e9;
            border-left: 6px solid #4CAF50;
            padding: 10px;
            margin-bottom: 16px;
        }

    </style>
</head>
<body>
    <div class="container">
    <h1>Food-expiry-tracker-App</h1>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <ul class="menu">
        <li><a class="btn1 primary" href="{{ route('images.create') }}">＋ 新しい食品情報を追加</a></li>
        <li><a class="btn1" href="{{ route('images.note') }}">⏰ 賞味期限情報</a></li>
    </ul>

    
    <h2>食品一覧</h2>
    @if(isset($images) && count($images) > 0)
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>食品名</th>
                    <th>賞味期限</th>
                    <th>保管場所</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $img)
                    <tr>
                        <td>{{ $img->food_name }}</td>
                        <td>{{ $img->expiration_date ? \Carbon\Carbon::parse($img->expiration_date)->format('Y年n月j日') : '未設定' }}</td>
                        <td>{{ $img->storage_location }}</td>
                        <td>
                            <a href="{{ route('food-images.edit', $img->id) }}" class="btn2 edit">編集</a>
                            <a href="{{ route('images.delete', $img->id) }}" class="btn2 danger">削除</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>まだデータはありません。</p>
    @endif
    </div>
</body>
</html>
