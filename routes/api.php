<?php

use App\Http\Controllers\Api\Auth\CreateUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\testController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Ui\AuthCommand;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Protected Routes
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// 	return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
	Route::get('/get', GetController::class);
	Route::post('/products', [ProductController::class, 'store']);
	Route::put('/products/{id}', [ProductController::class, 'update']);
	Route::delete('/products/{id}', [ProductController::class, 'destroy']);
	Route::get('/user', [UserController::class, 'index']);
	Route::get('/logout', [AuthController::class, 'logout']);
});

//Public Routes
// Route::resource('products', ProductController::class);


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);



Route::get('/get', GetController::class);
Route::post('/auth/register', CreateUserController::class);
// Route::post('/auth/login', [AuthController::class, 'loginUser']);
