<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/orders', [OrderController::class, "index"])->name("order.view");
Route::post('/orders', [OrderController::class, "create"])->name("order.create")->middleware("open.store");
