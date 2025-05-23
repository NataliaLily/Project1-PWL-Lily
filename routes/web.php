<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController; // Add this line to import WalletController
use App\Mail\TestingMail;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/coba/email', function(){
    Mail::to('lily@ukrim.ac.id')
    ->send(new TestingMail());
 });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('testing');

});
Route::middleware('auth')->group(function () {
    #dashboard 
    Route::get('/dashboard',[HomeController::class, 'index']);

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
    #impor pdf 
    Route::get('/wallet/{id}/reportPDF', [WalletController::class, 'reportPDF']);

   
    Route::get('/transaksi', [TransaksiController::class, 'list']);
    Route::get("/transaksi/add", [TransaksiController::class, 'add']);
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);

    #menu transfer
    Route::prefix("/transfer")->group(function () {
        Route::get("/", [TransferController::class, 'list']);
        Route::get("/add", [TransferController::class, 'add']);
        Route::post("/store", [TransferController::class, 'store']);
    });
});

#Route untuk Authentications
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'verifyLogin']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'prosesRegister']);
    Route::get('/register/verify/{email}/{token}', [AuthController::class, 'registerVerify']);

});

