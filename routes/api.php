<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [APIController::class, 'register']);
Route::post('/login', [APIController::class, 'login']);
Route::post('/forgot-password', [APIController::class, 'sendResetLink']);
Route::get('/get_inventarisasi', [APIController::class, 'get_inventarisasi']);
Route::get('/get_total', [APIController::class, 'get_total']);
Route::get('/inventarisasi/search', [APIController::class, 'search']);
Route::get('/get_kartu_ruang', [APIController::class, 'get_kartu_ruang']);
Route::post('/inventarisasi', [APIController::class, 'store']);
Route::get('/inventarisasi/{id}', [APIController::class, 'show']);
Route::put('/inventarisasi/{id}/update', [APIController::class, 'update']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [APIController::class, 'logout']);
});