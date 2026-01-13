<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>食品編集ページ</title>
        <style>
            body {
                font-family: "Segoe UI", "Hiragino Kaku Gothic ProN", sans-serif;
                background: #f5f6fa;
                margin: 0;
                padding: 24px;
            }

            h1 {
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
            button , a {
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
            .edit {
                background: #2196F3;
                color: white;
            }
            .edit:hover {
                background: #1976D2;
            }

            /* 削除 */
            .cancel {
                background: #f44336;
                color: white;
            }
            .cancel:hover {
                background: #d32f2f;
            }
        </style>
    </head>
    <body>
        <div class="container">
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
                        <th class="large"></th>
                        <th class="large">更新前</th>
                        <th class="large">更新後</th>
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
                <button type="submit" class="edit">更新する</button>
                <a href="{{ route('food-images.index') }}" class="cancel">戻る</a>
            </form>
        </div>
    </body>
</html>






