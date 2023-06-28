<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', [WorkController::class, 'view']);
Route::post('/', [WorkController::class, 'start']);
Route::get('/rest/start', [WorkController::class, 'restStartView']);
Route::post('/rest/start', [RestController::class, 'restStart']);
Route::get('/rest/end', [WorkController::class, 'restEndView']);
Route::post('/rest/end', [RestController::class, 'restEnd']);
Route::post('/end', [WorkController::class, 'end']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/attendance', [WorkController::class, 'index']);
Route::get('/before/attendance', [WorkController::class, 'beforeView']);
Route::post('before/attendance/yesterday', [WorkController::class, 'yesterdayView'])->name('yesterday');
Route::post('before/attendance/tomorrow', [WorkController::class, 'tomorrowView'])->name('tomorrow');
Route::post('before/attendance/thisday', [WorkController::class, 'todayView'])->name('today');

Route::get('/days', [WorkController::class, 'daysView']);

Route::get('/users', [WorkController::class, 'usersView']);
Route::post('/users', [WorkController::class, 'users'])->name('who');
Route::get('/person', [WorkController::class, 'personView']);

Route::get('/error', [RestController::class, 'errorView']);
Route::get('/error/same', [WorkController::class, 'errorSameView']);
