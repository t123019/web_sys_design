<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>賞味期限通知</title>

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

        .legend {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            max-width: 900px;
            margin: auto;
        }

        .expired {
            color: red;
            font-weight: bold;
        }
        .warning {
            color: orange;
            font-weight: bold;
        }
        .caution {
            color: blue;
        }

        /* ボタン風リンク */
        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #eee;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover {
            background: #ddd;
        }

        /* 訪問済みでも色を変えない */
        .btn:visited {
            color: #333;
        }

        .sort {
            margin: 12px 0;
        }

        ul {
            list-style: disc;
            padding-left: 20px;
        }


        li {
            margin: 6px 0;
        }
    </style>
</head>
<body>

<div class="legend">
    <h1>賞味期限が近い食品</h1>
    <span class="expired">■ 期限切れ</span>
    <span class="warning">■ 3日以内</span>
    <span class="caution">■ 1週間以内</span>

<br>
<br>

<hr>

    <div class="sort">
        <a href="?sort=place" class="btn" >
            保管場所ごと
        </a>
        　
        <a href="?sort=expiry" class="btn">
            賞味期限が近い順
        </a>
    </div>

    <hr>

    @if (request('sort', 'place') === 'expiry')

        {{-- 全体を賞味期限が近い順で表示 --}}
        <ul>
        @foreach ($foods as $food)
            @php
                if ($food->days_left < 0) {
                    $class = 'expired';
                    $label = '⚠期限切れ';
                } elseif ($food->days_left <= 3) {
                    $class = 'warning';
                    $label = 'あと ' . $food->days_left . ' 日';
                } elseif ($food->days_left <= 7) {
                    $class = 'caution';
                    $label = 'あと ' . $food->days_left . ' 日';
                } else {
                    $class = '';
                    $label = 'あと ' . $food->days_left . ' 日';
                }
            @endphp

            <li class="{{ $class }}">
                {{ $food->food_name }}
                （{{ $food->storage_location }} / {{ $label }}）

                @if ($food->days_left < 0)
                    <form action="{{ route('images.note_delete', $food) }}"
                          method="POST"
                          style="display:inline;"
                          onsubmit="return confirm('この食品を削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                @endif
            </li>
        @endforeach
        </ul>

    @else

        {{-- 保管場所ごと表示 --}}
        @foreach ($foods as $location => $group)
            <h3>【{{ $location ?? '未設定' }}（{{ count($group) }}件）】</h3>

            <ul>
            @foreach ($group as $food)
                @php
                    if ($food->days_left < 0) {
                        $class = 'expired';
                        $label = '⚠期限切れ';
                    } elseif ($food->days_left <= 3) {
                        $class = 'warning';
                        $label = 'あと ' . $food->days_left . ' 日';
                    } elseif ($food->days_left <= 7) {
                        $class = 'caution';
                        $label = 'あと ' . $food->days_left . ' 日';
                    } else {
                        $class = '';
                        $label = 'あと ' . $food->days_left . ' 日';
                    }
                @endphp

                <li class="{{ $class }}">
                    {{ $food->food_name }}（{{ $label }}）

                    @if ($food->days_left < 0)
                        <form action="{{ route('images.note_delete', $food) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('この食品を削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                    @endif
                </li>
            @endforeach
            </ul>
        @endforeach

    @endif

    <br>

    <a href="{{ route('images.index') }}" class="btn">戻る</a>
</div>

</body>
</html>
