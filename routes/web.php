<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\TweetLikesController;
use App\Http\Controllers\TweetsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth')->group(function (){

    Route::get('/tweets', [TweetsController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetsController::class, 'store']);

    Route::post('/tweets/{tweet}/like',[TweetLikesController::class,'store']);
    Route::delete('/tweets/{tweet}/like',[TweetLikesController::class,'destroy']);

    Route::post('/profiles/{user:username}/follow',[FollowsController::class, 'store'])->name('follow');
    Route::get('/profiles/{user:username}/edit',[ProfilesController::class, 'edit'])->middleware('can:edit,user');

    Route::patch('/profiles/{user:username}',[ProfilesController::class, 'update'])->middleware('can:edit,user');

    Route::get('/explore',[ExploreController::class,'index']);
    Route::delete('/tweets/{tweet}',[TweetsController::class,'destroy'])->name('tweets.destroy');
});
Route::get('/notifications', [NotificationController::class,'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
Route::get('/profiles/{user:username}',[ProfilesController::class, 'show'])->name('profile');


Auth::routes();



