<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>賞味期限通知</title>

    <style>
        body {
            font-family: sans-serif;
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
        button {
            margin-left: 8px;
            font-size: 0.9em;
        }
        .legend {
            margin-bottom: 8px;
            font-size: 0.9em;
        }
        .legend span {
            margin-right: 12px;
        }
        .sort {
            margin-bottom: 10px;
        }

        .sort a {
            text-decoration: none;
            padding: 4px 8px;
            border: 1px solid #ccc;
            margin: 0 4px;
        }

        .sort .active {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>

<h2>賞味期限が近い食品</h2>

<div class="legend">
    <span class="expired">■ 期限切れ</span>
    <span class="warning">■ 3日以内</span>
    <span class="caution">■ 1週間以内</span>
</div>

<hr>
<div class="sort">
    表示順：
    <a href="?sort=place" class="{{ request('sort', 'place') === 'place' ? 'active' : '' }}">
        保管場所ごと
    </a>
    |
    <a href="?sort=expiry" class="{{ request('sort') === 'expiry' ? 'active' : '' }}">
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
                <form action="{{ route('images.destroy', $food) }}"
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
                    <form action="{{ route('images.destroy', $food) }}"
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

<a href="{{ route('images.index') }}">[ 一覧へ戻る ]</a>

</body>
</html>
