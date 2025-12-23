<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>食品削除確認ページ</title>
    </head>
    <body>
        <h1>食品削除確認#{{ $foodImage->id }}</h1>

        <p style="color:red;">
            以下の食品情報を削除します。<br>
            本当によろしいですか？
        </p>

        <ul>
            <li>食品名：{{ $foodImage->food_name }}</li>
            <li>賞味期限：{{ $foodImage->expiration_date }}</li>
            <li>保管場所：{{ $foodImage->storage_location }}</li>
        </ul>
        <form method="POST" action="{{ route('food-images.destroy', $foodImage) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:blue; color:white;">削除する</button>
        </form>

        <form method="GET" action="{{ route('images.index') }}" style="display:inline;">
            <button type="submit">キャンセル</button>
        </form>
    </body>
</html>
