<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>食品編集ページ</title>
        <style>
            h1 {
                color: red;
            }
            td {
                width: 200px;
            }
            .large {
                font-size: larger;
                font-weight: bold;
                text-align: center;
                width: auto;
            }
            .inp {
                background-color: yellow;
            }
            input {
                width: 150px;
                font-size: large;
            }
            button, a {
                color: black;
                cursor: pointer;
            }
            button:hover, a:hover {
                color: violet;
            }
        </style>
    </head>
    <body>
        <h1>食品編集</h1>

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
            <table border=1>
                <tr>
                    <td class="large"></td>
                    <td class="large">更新前</td>
                    <td class="large">更新後</td>
                </tr>
                <tr>
                    <td class="large">食品名</td>
                    <td>{{ old('food_name', $foodImage->food_name) }}</td>
                    <td class="inp"><input name="food_name" value="{{ old('food_name', $foodImage->food_name) }}"></td>
                </tr>
                <tr>
                    <td class="large">賞味期限</td>
                    <td>{{ old('expiration_date', $foodImage->expiration_date) }}</td>
                    <td class="inp"><input type="date" name="expiration_date" value="{{ old('expiration_date', $foodImage->expiration_date) }}"></td>
                </tr>
                <tr>
                    <td class="large">保管場所</td>
                    <td>{{ old('storage_location', $foodImage->storage_location) }}</td>
                    <td class="inp"><input name="storage_location" value="{{ old('storage_location', $foodImage->storage_location) }}"></td>
                </tr>
            </table>
            <br>
            <button type="submit">更新する</button>
            <button><a href="{{ route('food-images.index') }}">戻る</a></button>
        </form>
        
    </body>
</html>


