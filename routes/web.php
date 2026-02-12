<?php
// ★これを一番上の方（<?php の下あたり）に追加してください
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// ★これを一番下に追加してください
Route::get('/weather', [WeatherController::class, 'index']);