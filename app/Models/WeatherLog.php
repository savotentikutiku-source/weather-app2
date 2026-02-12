<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherLog extends Model
{
    use HasFactory;

    // ★この3行を追加！「これらの項目なら保存していいよ」という許可証
    protected $fillable = [
        'date',
        'max_temp',
        'min_temp', // もしmigrationで作っていれば
    ];
}
