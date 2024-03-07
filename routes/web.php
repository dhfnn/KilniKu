<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\Login;
use App\Http\Controllers\DashPage;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\pelangganPetugas;
use App\Http\Controllers\produkController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\transController;
use App\Http\Controllers\transPetugas;
use App\Http\Middleware\roleAkses;

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function(){
    Route::get('/', [Login::class, 'index'])->name('login');
    Route::post('/', [Login::class,'login']);
});

Route::get('/home', function(){
    return redirect('/admin/dashboard');
});

Route::middleware(['auth'])->group(function(){
    Route::middleware(['roleAkses:admin'])->group(function(){
        Route::get('/admin/dashboard', [DashPage::class, 'admin']);
        Route::get('/getDataDash', [DashPage::class, 'getDataDash']);
        Route::get('/getDataTP', [DashPage::class, 'getDataTP']);
        Route::get('/dataTransDash', [DashPage::class, 'dataTransDash']);

        Route::resource('data/dataAkun', akunController::class);
        Route::controller(akunController::class)->group(function (){
            route::get('/getDataAkun', 'getData');
            route::get('/getDataEm', 'getDataEm');
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
        Route::post('/update-karyawan/{id}', [karyawanController::class, 'update'])->name('update.karyawan');
        Route::resource('/data/dataKaryawan', karyawanController::class);
        route::controller(karyawanController::class)->group(function(){
            Route::get('/getDatakaryawan', 'getData');

        });
        Route::resource('/admin/transaksi', transController::class);
        Route::post('/update-produk/{id}', [produkController::class, 'update']);
        Route::resource('/produk', produkController::class);
        route::controller(produkController::class)->group(function(){

            Route::get('/getsupplierAdmin', 'getsupplier');

        });




    });
    Route::get('/getDataProdukAdmin', [produkController::class, 'getData']);

    Route::get('/produk2/{id}/edit', [produkController::class, 'edit2']);
    Route::get('/admin/riwayat', [transController::class, 'riwayat']);
    route::controller(transController::class)->group(function(){
        Route::get('/getDataRiwayat','getDataRiwayat');
    });
    Route::middleware(['roleAkses:petugas'])->group(function(){
        route::resource('/petugas/transaksi', transPetugas::class);
        route::get('/petugas/riwayat',[ transPetugas::class, 'riwayat']);
        Route::get('/petugas/produk', [produkController::class, 'produkPetugas']);
        Route::get('/getDataProduk', [produkController::class, 'getData']);
        Route::get('/getsupplier', [produkController::class, 'getsupplier']);
        Route::get('/getDataRiwayatP',[transPetugas::class, 'riwayat']);



        Route::resource('/pasien' ,pelangganPetugas::class);
        route::controller(pelangganPetugas::class)->group(function(){
            Route::get('/getDataPelanggan2' ,'getData');
            route::get('/pasien/{id}/edit', 'edit');
            route::get('/pasien/{id}', 'update');
            route::delete('/data/dataAkun/{id}', 'destroy');
        });

    });

});


Route::POST('/update-stock/{id}', [produkController::class, 'updateStock']);
Route::get('/logout', [Login::class, 'logout']);