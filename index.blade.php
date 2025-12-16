<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Food-expiry-tracker-App (一覧表示)</title>
</head>
<body>
    <h1>Food-expiry-tracker-App</h1>
    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif
    <p>
    <a href="{{ route('images.create') }}">＋ 新しい食品情報を追加</a>
</p>
    <h2>画像一覧（food_images テーブル）</h2>
    @if(isset($images) && count($images) > 0)
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>食品名</th>
                    <th>賞味期限</th>
                    <th>保管場所</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $img)
                    <tr>
                        <td>{{ $img->id }}</td>
                        <td>{{ $img->food_name }}</td>
                        <td>{{ $img->expiration_date }}</td>
                        <td>{{ $img->storage_location }}</td>
                        <td>{{ $img->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>まだデータはありません。</p>
    @endif
</body>
</html>