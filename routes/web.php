<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDecisionController;
use App\Http\Controllers\UserFriendController;
use App\Http\Controllers\UserGenreController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('genre', UserGenreController::class)
    ->middleware(['auth', 'verified']);

Route::resource('show', \App\Http\Controllers\ShowController::class)
    ->middleware(['auth', 'verified']);

Route::resource('friend', UserFriendController::class)
    ->middleware(['auth', 'verified']);

Route::get('friend-match/{user}', [UserFriendController::class, 'match'])
    ->name('friend.match')
    ->middleware(['auth', 'verified']);

Route::get('friend/{user}/matches', [UserFriendController::class, 'matches'])
    ->name('friend.matches')
    ->middleware(['auth', 'verified']);

Route::get('friend-share', [UserFriendController::class, 'share'])
    ->name('friend.share')
    ->middleware(['auth', 'verified']);

Route::resource('decision', UserDecisionController::class)
    ->middleware(['auth', 'verified']);

Route::get('decision-list', [UserDecisionController::class, 'show'])
    ->name('decision.show')
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
