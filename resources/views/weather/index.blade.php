<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>米子市 花粉＆気温予報</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .warning { color: red; font-weight: bold; font-size: 1.2em; border: 2px solid red; padding: 10px; background-color: #ffe6e6; }
        .safe { color: green; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1>🌲 米子市の花粉予報（400度の法則）</h1>

    <div class="card">
        <h2>現在の状況</h2>
        <p>1月1日からの累積最高気温: <strong>{{ $totalTemp }} 度</strong></p>

        @if ($isPollenActive)
            <p class="warning">⚠️ 400度を超えました！スギ花粉の飛散開始に注意してください！</p>
        @else
            <p class="safe">✅ まだ400度には達していません。花粉はまだのようです。</p>
            <p>あと {{ 400 - $totalTemp }} 度で到達します。</p>
        @endif
    </div>

    <h3>📅 日別の最高気温データ</h3>
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>最高気温</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dailyData as $data)
                <tr>
                    <td>{{ $data['date'] }}</td>
                    <td>{{ $data['temp'] }} ℃</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>