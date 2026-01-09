<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserControlController;
use App\Http\Controllers\KartuRuangController;
use App\Http\Controllers\InventarisasiController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
})->name('welcome');

Route::get('inventarisasi/{id}/print', [InventarisasiController::class, 'print'])->name('inventarisasi.print');
Route::get('/inventarisasi/pdf/{id}', [InventarisasiController::class, 'cetakviaqr'])->name('inventarisasi.pdf');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/settings', [UserControlController::class, 'settings'])->name('settings');
    Route::get('/kelola_akun', [UserControlController::class, 'kelola_akun'])->name('kelola_akun');
    Route::get('/kelola_akses', [UserControlController::class, 'kelola_akses'])->name('kelola_akses');
    Route::post('/kelola_akses/add_role', [UserControlController::class, 'store'])->name('kelola_akses.store');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    
    Route::resources([
        'kir' => KartuRuangController::class,
        'inventarisasi' => InventarisasiController::class
    ]);

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});

