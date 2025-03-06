<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController; // Add this line to import WalletController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('testing');
});
Route::middleware('auth')->group(function () {

    Route::get('/user', [UserController::class, 'list']);
    Route::get('/user/add', [UserController::class, 'add']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name("user.edit");
    Route::post("user/update", [UserController::class, 'update']);
    Route::get('/user/{id}/delete', [UserController::class, 'delete']);

    Route::get('/kategori', [KategoriController::class, 'list']);
    Route::get('/kategori/add', [KategoriController::class, 'add']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name("kategori.edit");
    Route::post("kategori/update", [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/delete', [KategoriController::class, 'delete']);

    Route::get('/wallet', [WalletController::class, 'list']);
    Route::get('/wallet/add', [WalletController::class, 'add']);
    Route::post('/wallet/store', [WalletController::class, 'store']);
    Route::get('/wallet/{id}/edit', [WalletController::class, 'edit'])->name("wallet.edit");
    Route::post("wallet/update", [WalletController::class, 'update']);
    Route::get('/wallet/{id}/delete', [WalletController::class, 'delete']);
});

#Route untuk Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'verifyLogin']);