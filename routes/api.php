<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MagazineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/** Добавление автора */
Route::middleware('guest')->post('/author/add', [AuthorController::class,'add']);

/** Редактирование автора по id */
Route::middleware('guest')->post('/author/update/{id}', [AuthorController::class,'update']);

/** Удаление автора по id */
Route::middleware('guest')->post('/author/delete/{id}', [AuthorController::class,'delete']);

/** Просмотр авторов */
Route::middleware('guest')->get('/author/list', [AuthorController::class,'index']);


/** Добавление журнала */
Route::middleware('guest')->post('/magazine/add', [MagazineController::class,'add']);

/** Редактирование журнала по id */
Route::middleware('guest')->post('/magazine/update/{id}', [MagazineController::class,'update']);

/** Удаление журнала по id */
Route::middleware('guest')->post('/magazine/delete/{id}', [MagazineController::class,'delete']);

/** Просмотр журналов */
Route::middleware('guest')->get('/magazine/list', [MagazineController::class,'index']);
