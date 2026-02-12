<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherLog; // ★重要：さっき作った「管理人（モデル）」を呼び出す

class WeatherController extends Controller
{
    public function index()
    {
        // 1. 設定
        $startDate = '2026-01-01';
        $today = date('Y-m-d');

        // 2. APIからデータを取る
        $response = Http::get("https://api.open-meteo.com/v1/forecast", [
            'latitude' => 35.428,
            'longitude' => 133.331,
            'daily' => 'temperature_2m_max',
            'timezone' => 'Asia/Tokyo',
            'start_date' => $startDate,
            'end_date' => $today,
        ]);

        $data = $response->json();
        
        // 3. 【ここが新機能】データを保存する！
        if (isset($data['daily']['time'])) {
            $dates = $data['daily']['time'];
            $temps = $data['daily']['temperature_2m_max'];

            // 取得した日数分だけループして保存
            foreach ($dates as $index => $date) {
                // updateOrCreate: 「もしその日付のデータがあれば更新、なければ新規作成」
                // これなら何度実行してもデータが重複しません！
                WeatherLog::updateOrCreate(
                    ['date' => $date],           // 検索条件（日付が同じなら…）
                    ['max_temp' => $temps[$index]] // 気温を上書き保存！
                );
            }
        }

        // 4. データベースから全データを取得して計算（APIの結果ではなく、DBの結果を使う）
        // 日付順に並べて取得
        $logs = WeatherLog::orderBy('date', 'asc')->get();

        $totalTemp = 0;
        $dailyData = []; // ビューに渡すための整形データ

        foreach ($logs as $log) {
            // 1月1日以降のデータだけ足し算する（念のため）
            if ($log->date >= $startDate) {
                $totalTemp += $log->max_temp;
                
                // ビュー表示用に配列に詰める
                $dailyData[] = [
                    'date' => $log->date,
                    'temp' => $log->max_temp
                ];
            }
        }

        // 5. 判定
        $isPollenActive = ($totalTemp >= 400);

        // 6. 画面へ
        return view('weather.index', compact('totalTemp', 'isPollenActive', 'dailyData'));
    }
}