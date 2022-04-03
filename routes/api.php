<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('message', [App\Http\Controllers\MessageController::class, 'index'])->name('message.index');
// Route::post('message', [App\Http\Controllers\MessageController::class, 'store'])->name('message.store');

Route::resource('messages', MessageController::class)->only([
    'store', 'index'
 ]);

// Route::get('/uploads', function() {
//     return File::get('/uploads');
// });