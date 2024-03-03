<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\Login;
use App\Http\Controllers\DashPage;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\supplierController;
use App\Http\Middleware\roleAkses; // Ubah "app" menjadi "App"

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [Login::class, 'index'])->name('login');
    Route::post('/', [Login::class,'login']);
});

Route::get('/home', function(){
    return redirect('/admin/dashboard');
});

Route::middleware(['auth'])->group(function(){
    Route::middleware(['roleAkses:admin'])->group(function(){ // Ubah "route::middleware" menjadi "Route::middleware"
        Route::get('/admin/dashboard', [DashPage::class, 'admin']);

        Route::resource('data/dataAkun', akunController::class);
        Route::controller(akunController::class)->group(function (){
            route::get('/getDataAkun', 'getData');
            route::get('/data/dataAkun/{id}/edit', 'edit');
            route::get('/data/dataAkun/{id}', 'update');
            route::delete('/data/dataAkun/{id}', 'destroy');
        });

        Route::resource('data/dataPelanggan' ,pelangganController::class);
        route::controller(pelangganController::class)->group(function(){
            Route::get('/getDataPelanggan' ,'getData');
            route::get('/data/dataPelanggan/{id}/edit', 'edit');
            route::get('/data/dataPelanggan/{id}', 'update');
            route::delete('/data/dataAkun/{id}', 'destroy');
        });

        Route::resource('data/dataSupplier', supplierController::class);
        route::controller(supplierController::class)->group(function(){
            Route::get('/getDatasupplier', 'getData');
            route::get('/data/dataSupplier/{id}/edit', 'edit');
            route::get('/data/dataSupplier/{id}', 'update');
        });
        Route::resource('/data/dataKaryawan', karyawanController::class);
        route::controller(karyawanController::class)->group(function(){
            Route::get('/getDatakaryawan', 'getData');
            // route::get('/data/dataKaryawan/{id}/edit', 'edit');

        });
        Route::resource('/produk', produkController::class);
        route::controller(produkController::class)->group(function(){
            Route::get('/getDataProduk', 'getData');
            Route::get('/getsupplier', 'getsupplier');
            // Route::get('/produk/{id}', 'update');

        });



    });

    Route::middleware(['roleAkses:petugas'])->group(function(){
        Route::get('/petugas', [DashPage::class, 'petugas']);
    });

});

Route::get('/logout', [Login::class, 'logout']);