<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 2. Tambahkan baris ini untuk mendaftarkan CRUD Task
});

Route::apiResource('tasks', TaskController::class);
