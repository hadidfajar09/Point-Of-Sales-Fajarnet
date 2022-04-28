<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SpendController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn() => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.home');
    })->name('dashboard');
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
    Route::resource('/category',CategoryController::class);

    Route::get('/product/data', [ProductController::class, 'data'])->name('product.data');
    Route::post('/product/delete-selected', [ProductController::class, 'deleteSelected'])->name('product.deleteselected');
    Route::post('/product/cetak-barcode', [ProductController::class, 'cetakBarcode'])->name('product.barcode');
    Route::resource('/product',ProductController::class);

    Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
    Route::resource('/member',MemberController::class);
    Route::post('/member/cetak-barcode', [MemberController::class, 'cetakBarcode'])->name('member.barcode');

    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier',SupplierController::class);

    Route::get('/spend/data', [SpendController::class, 'data'])->name('spend.data');
    Route::resource('/spend',SpendController::class);

    Route::get('/purchase/data', [purchaseController::class, 'data'])->name('purchase.data');
    Route::get('/purchase/{id}/create', [purchaseController::class, 'create'])->name('purchase.create');
    Route::resource('/purchase',PurchaseController::class)->except('create');

    Route::get('/purchase-detail/{id}/data', [PurchaseDetailController::class, 'data'])->name('purchase_detail.data');
    Route::get('/purchase-detail/loadform/{discount}/{total}', [PurchaseDetailController::class, 'loadForm'])->name('purchase_detail.loadform');
    Route::resource('/purchase-detail',PurchaseDetailController::class)->except('create','show','edit');

    Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');
    Route::get('/sale/data', [SaleController::class, 'data'])->name('sale.data');
    Route::get('/sale/{id}', [SaleController::class, 'show'])->name('sale.show');
    Route::delete('/sale/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');

    Route::get('/transaksi/baru', [SaleController::class, 'create'])->name('transaksi.baru');
    Route::get('/transaksi/nota_kecil', [SaleController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    Route::get('/transaksi/nota_besar', [SaleController::class, 'notaBesar'])->name('transaksi.nota_besar');
    Route::post('/transaksi/simpan', [SaleController::class, 'store'])->name('transaksi.simpan');
    
    Route::get('/transaksi/selesai', [SaleDetailController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/{id}/data', [SaleDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{discount}/{total}/{diterima}', [SaleDetailController::class, 'loadForm'])->name('transaksi.loadform');
    Route::resource('/transaksi',SaleDetailController::class)->except('show');


    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/refresh', [LaporanController::class, 'refresh'])->name('laporan.refresh');
    Route::get('/transaksi/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
    Route::get('/transaksi/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPdf'])->name('laporan.export');

});
