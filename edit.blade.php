<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>食品編集ページ</title>
    </head>
    <body>
        <h1>食品編集#{{ $foodImage->id }}</h1>

        @if($errors->any())
            <ul style="color:red">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('food-images.update', $foodImage) }}">
            @csrf
            @method('PUT')
            <p>
                食品名:
                <input name="food_name" value="{{ old('food_name', $foodImage->food_name) }}">
            </p>
            <p>
                賞味期限:
                <input name="expiration_date" value="{{ old('expiration_date', $foodImage->expiration_date) }}">
            </p>
            <p>
                保管場所:
                <input name="storage_location" value="{{ old('storage_location', $foodImage->storage_location) }}">
            </p>
            <button type="submit">更新する</button>
        </form>

        <p>
            <a href="{{ route('food-images.index') }}">戻る</a>
        </p>
    </body>
</html>
