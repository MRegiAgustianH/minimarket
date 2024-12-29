<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\CabangStokController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengadaanStokController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Cabang;
use App\Models\CabangStok;
use App\Models\Produk;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user(); 
    if ($user->hasRole('kasir')) { 
        $cabangStoks = CabangStok::with('produk')
            ->where('cabang_id', $user->cabang_id) 
            ->get();
    } else {
        $cabangStoks = CabangStok::with('produk')->get();
    }

    return view('dashboard', ['cabangStoks' => $cabangStoks]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:owner']], function () {
    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
    Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
    // Route::get('/cabang/edit/{id}', [CabangController::class, 'edit'])->name('cabang.edit');
    Route::post('/cabang/create', [CabangController::class, 'store'])->name('cabang.store');
    // Route::patch('/cabang/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
    // Route::delete('/cabang/{id}/delete',[CabangController::class, 'destroy'])->name('cabang.destroy');
    Route::delete('/cabang/{id}', [CabangController::class, 'destroy'])->name('cabang.destroy');

    // Route::get('/cabang/print', [CabangController::class, 'print'])->name('cabang.print');
    // Route::get('/cabang/export', [CabangController::class, 'export'])->name('cabang.export');
    // Route::post('/cabang/import', [CabangController::class, 'import'])->name('cabang.import');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/laporan', [LaporanController::class, 'laporanTransaksi'])->name('laporan.transaksi');
    Route::get('/laporan', [LaporanController::class, 'laporanStok'])->name('laporan.stok');
    Route::get('/laporan/transaksi', [LaporanController::class, 'laporanTransaksi'])->name('laporan.transaksi');
    Route::get('/laporan/transaksi/transaksiBulanan', [LaporanController::class, 'laporanTransaksi'])->name('transaksi_bulanan');
    Route::get('/laporan/transaksi/transaksiTahunan', [LaporanController::class, 'laporanTransaksi'])->name('transaksi_tahunan');
    Route::get('/laporan/stok', [LaporanController::class, 'laporanStok'])->name('laporan.stok');
});

Route::group(['middleware'=> ['role:supervisor']],function(){
    Route::get('/cabang/stok',[CabangStokController::class,'index'])->name('cabang.stok');
    Route::post('/cabang/stok', [CabangStokController::class, 'create'])->name('cabang.stok');
    Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
});


Route::group(['middleware'=> ['role:kasir']],function(){
    Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});

Route::group(['middleware' => ['role:supervisor|kasir|manager|owner|pegawai']], function() {
    Route::get('/cabang/stok', [CabangStokController::class, 'index'])->name('cabang.stok');
    Route::post('/cabang/stok', [CabangStokController::class, 'create'])->name('cabang.stok');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    
});
Route::group(['middleware'=> ['role:pegawai']],function(){
    Route::get('/gudang',[PengadaanStokController::class,'index'])->name('gudang.index');
    Route::post('/gudang/approve/{id}', [PengadaanStokController::class, 'approve'])->name('gudang.approve');
});

Route::group(['middleware'=> ['role:manager']],function(){
    Route::get('/gudang/create', [PengadaanStokController::class, 'create'])->name('gudang.create');
    Route::post('/gudang', [PengadaanStokController::class, 'store'])->name('gudang.store');
    
});



require __DIR__.'/auth.php';
