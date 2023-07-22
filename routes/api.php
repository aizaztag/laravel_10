<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class);

Route::get('/batch', [PostController::class, 'batch']);
Route::resource('posts', PostController::class);
Route::post('upload-csv',  [PostController::class, 'store'])->name('upload-csv')->middleware('cors');
Route::get('/batch/in-progress', [PostController::class, 'batchInProgress']);


Route::get('/users', function() {
    $users = \App\Models\User::select('id', 'name', 'email');

    return datatables($users)->make(true);
});
