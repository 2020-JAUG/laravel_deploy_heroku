<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//AQUI IMPORTAMOS LOS ARCHIVOS PARA PODER USAR SUS FUNCIONES
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::resource('posts', PostController::class);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('profile', [UserController::class, 'show'])->middleware('auth');
// Route::apiResource('post', App/http)