<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlokController;
use App\Http\Controllers\CicilanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\TagihanController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Middleware\RedirectIfNotClient;
use App\Models\Customer;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Route;




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/send/{phone}', [TagihanController::class, 'send'])->name('send');

Route::get('kwitansi/export', [ClientController::class, 'export'])->name('kwitansi.export');

Route::middleware(['auth.session'])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::middleware([RedirectIfNotAdmin::class])->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

            Route::middleware(CheckUserRole::class)->group(function () {
                Route::get('/admin', [AdminController::class, 'index'])->name('admin');
                Route::get('/admin/create', [AdminController::class, 'create'])->name('create-admin');
                Route::post('/admin/create', [AdminController::class, 'store'])->name('store-admin');
                Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('edit-admin');
                Route::post('/admin/edit/{user}', [AdminController::class, 'update']);
                Route::get('/admin/delete/{user}', [AdminController::class, 'delete'])->name('delete-admin');
                Route::get('/admin/search/', [AdminController::class, 'search'])->name('search-admin');
            });


            Route::get('/rumah', [RumahController::class, 'index'])->name('rumah');
            Route::get('/rumah/search', [RumahController::class, 'search']);
            Route::get('/rumah/create', [RumahController::class, 'create'])->name('create-rumah');
            Route::post('/rumah/create', [RumahController::class, 'store'])->name('store-rumah');
            Route::get('/rumah/edit/{rumah}', [RumahController::class, 'edit'])->name('edit-rumah');
            Route::post('/rumah/edit/{rumah}', [RumahController::class, 'update']);
            Route::get('/rumah/delete/{rumah}', [RumahController::class, 'delete'])->name('delete-rumah');
            Route::get('/rumah/search/blok', [RumahController::class, 'searchMain'])->name('search-rumah');

            Route::get('/rumah/blok', [BlokController::class, 'index'])->name('blok');
            Route::get('/rumah/blok/create', [BlokController::class, 'create'])->name('create-blok');
            Route::post('/rumah/blok/create', [BlokController::class, 'store'])->name('store-blok');
            Route::get('/rumah/blok/edit/{blok}', [BlokController::class, 'edit'])->name('edit-blok');
            Route::post('/rumah/blok/edit/{blok}', [BlokController::class, 'update']);
            Route::get('/rumah/blok/delete/{blok}', [BlokController::class, 'delete'])->name('delete-blok');

            Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
            Route::get('/customer/create', [CustomerController::class, 'create'])->name('create-customer');
            Route::post('/customer/create', [CustomerController::class, 'store'])->name('store-customer');
            Route::get('/customer/detail/{customer}', [CustomerController::class, 'detail'])->name('detail-customer');
            Route::post('/customer/detail/{customer}', [CustomerController::class, 'update']);
            Route::get('/customer/delete/{customer}', [CustomerController::class, 'delete'])->name('delete-customer');
            Route::get('/customer/search/', [CustomerController::class, 'search'])->name('search-customer');


            // Route::get('/pembayaran/bayardp', [PembayaranController::class, 'bayardp'])->name('bayardp');
            // Route::post('/pembayaran/bayardp', [PembayaranController::class, 'storedp']);


            Route::get('/cicilan', [CicilanController::class, 'index'])->name('cicilan');
            // Route::get('/cicilan/create', [CicilanController::class, 'create'])->name('create-cicilan');
            // Route::post('/cicilan/create', [CicilanController::class, 'store'])->name('store-cicilan');
            Route::get('/cicilan/detail/{cicilan}', [CicilanController::class, 'detail'])->name('detail-cicilan');
            Route::get('/cicilan/pengingat/{customer}', [CicilanController::class, 'pengingat'])->name('pengingat');
            Route::get('/cicilan/pengingatJapo/{customer}', [CicilanController::class, 'pengingatJapo'])->name('pengingat-japo');
            // Route::post('/cicilan/detail/{cicilan}', [CicilanController::class, 'update']);
            // Route::get('/cicilan/delete/{cicilan}', [CicilanController::class, 'delete'])->name('delete-cicilan');
            Route::get('/cicilan/search/', [CicilanController::class, 'search'])->name('search-cicilan');
            Route::post('/cicilan/tagihan/store/{customer}', [CicilanController::class, 'storeTagihan'])->name('storeTagihan');
            Route::get('/cicilan/delete/{tagihan}', [CicilanController::class, 'delete'])->name('delete-cicilan');

            
            Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
            // Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('create-pembayaran');
            // Route::post('/pembayaran/create', [PembayaranController::class, 'store'])->name('store-pembayaran');
            Route::get('/pembayaran/detail/{pembayaran}', [PembayaranController::class, 'detail'])->name('detail-pembayaran');
            Route::post('/pembayaran/detail/{pembayaran}', [PembayaranController::class, 'update']);
            // Route::get('/pembayaran/delete/{cicilan}', [PembayaranController::class, 'delete'])->name('delete-pembayaran');
            Route::get('/pembayaran/search/', [PembayaranController::class, 'search'])->name('search-pembayaran');
        });
    });



    Route::middleware(RedirectIfNotClient::class)->group(function () {
        Route::get('/client', [ClientController::class, 'index'])->name('client');
        Route::get('/client/cicilan', [ClientController::class, 'cicilan'])->name('client.cicilan');
        Route::get('/client/riwayat', [ClientController::class, 'riwayat'])->name('client.riwayat');
        Route::get('/client/bayar/{tagihan}', [ClientController::class, 'bayar'])->name('client.bayar');
        Route::post('/client/bayar/{tagihan}', [ClientController::class, 'storeBayar']);
        Route::get('/client/pembayaran', [ClientController::class, 'pembayaran'])->name('client.pembayaran');
        Route::get('/client/riwayat/{pembayaran}', [ClientController::class, 'detail'])->name('client.detail');
        Route::get('/client/kwitansi/', [ClientController::class, 'kwitansi'])->name('client.kwitansi');
    });
});
