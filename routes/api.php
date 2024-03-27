<?php

use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [UserAuthController::class, 'register'])->name("register");
Route::post('login', [UserAuthController::class, 'login'])->name("login");
Route::post('logout', [UserAuthController::class, 'logout'])
    ->middleware('auth:sanctum');
Route::middleware("auth:sanctum")->group(function () {
    Route::resource("progress", ProgressController::class)->except("create", "edit");
    Route::get("progress/{progress}/status", [ProgressController::class, "toggleStatus"]);
});
