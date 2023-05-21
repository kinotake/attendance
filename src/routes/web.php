<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;


Route::get('/', [WorkController::class, 'view']);
Route::post('/', [WorkController::class, 'start']);
Route::get('/rest/start', [RestController::class, 'restStartView']);
Route::post('/rest/start', [RestController::class, 'restStart']);
Route::get('/rest/end', [RestController::class, 'restEndView']);
Route::get('/rest/end', [RestController::class, 'restEnd']);



Route::get('/attendance', [WorkController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');