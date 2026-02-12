<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_logs', function (Blueprint $table) {
            $table->id();

        // ★ここから下を追加してください
        $table->date('date')->unique();       // 日付（同じ日付は登録できないようにする）
        $table->float('max_temp');            // 最高気温（小数点が使えるようにfloat）
        // ★追加はここまで

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_logs');
    }
};
