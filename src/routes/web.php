<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;


Route::get('/', [WorkController::class, 'view']);
Route::post('/', [WorkController::class, 'start']);
Route::get('/end', [WorkController::class, 'endView']);
Route::post('/end', [WorkController::class, 'end']);
Route::get('/rest/start', [WorkController::class, 'restStartView']);
Route::post('/rest/start', [RestController::class, 'restStart']);
Route::get('/rest/end', [WorkController::class, 'restEndView']);
Route::post('/rest/end', [RestController::class, 'restEnd']);



Route::get('/attendance', [WorkController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');