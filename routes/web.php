<?php

use App\Http\Controllers\PatterMatchingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSearchHistoryController;
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
})->name('home');

Route::get('/user-search-history', [UserSearchHistoryController::class, 'index'])->name('user-search-history');
Route::post('/get-filtered-user-search-history', [UserSearchHistoryController::class, 'getFilteredData'])->name('get-filtered-user-search-history');

Route::get('/pattern-matching', [PatterMatchingController::class, 'index'])->name('pattern-matching');
Route::post('/get-pattern-matched-info', [PatterMatchingController::class, 'getMatchedInfo'])->name('get-pattern-matched-info');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
