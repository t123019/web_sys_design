<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Food-expiry-tracker-App (一覧表示)</title>
    <style>
        .btn-edit {
            padding: 4px 8px;
            border: 1px solid #333;
            background: #eee;
            text-decoration: none;
            color: black;
        }
        .btn-edit:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <h1>Food-expiry-tracker-App</h1>
    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif
    <ul>
        <li><a href="{{ route('images.create') }}">新しい食品情報を追加</a></li>
        <li><a href="{{ route('images.note') }}">賞味期限情報</a></li>
    </ul>
    <h2>画像一覧（food_images テーブル）</h2>
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
                        <td>{{ $img->expiration_date }}</td>
                        <td>{{ $img->storage_location }}</td>
                        <td>
                            <a href="{{ route('images.edit', $img->id) }}" class="btn-edit">編集</a>
                            
                            <!-- 編集ページへ（GET） -->
                            <form action="{{ route('images.edit', $img->id) }}"
                                method="GET"
                                style="display:inline;">
                                <button type="submit">編集</button>
                            </form>

                            <!-- 削除確認ページへ（GET） -->
                            <form action="{{ route('images.delete', $img->id) }}"
                                method="GET"
                                style="display:inline;">
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>まだデータはありません。</p>
    @endif
</body>

</html>





