<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TaskController::class, 'index']);
Route::post('/add', [TaskController::class, 'store']);
Route::get('/delete/{id}', [TaskController::class, 'destroy']);
Route::get('/toggle/{id}', [TaskController::class, 'toggle']);
Route::get('/edit/{id}', [TaskController::class, 'edit']);
Route::post('/update/{id}', [TaskController::class, 'update']);