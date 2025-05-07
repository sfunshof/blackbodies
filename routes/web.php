<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//This is the actual production one
if (config('app.env') === 'production') {
    Route::domain(config('app.domains.admin'))->group(function () {
        Route::get('/', [AppController::class, 'index_admin'])->name('appLogin');
    });

} else if (config('app.env') === 'local') {
    Route::get('/admin', [AppController::class, 'index_admin'])->name('appLogin');
}
Route::get('/', [AppController::class, 'index'])->name('refLogin');