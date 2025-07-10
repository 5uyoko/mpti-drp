<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Auth::routes([
    'register' => false, // disable register
    'reset' => false, // disable reset password
    'verify' => false, // disable verifikasi email saat pendaftaran
]);

// BASE
Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/password', 'HomeController@password')->name('password');
    Route::get('/transaksi', 'HomeController@transaksi')->name('transaksi');
    Route::get('/kapal', [App\Http\Controllers\ShipController::class, 'index'])->name('kapal');
    Route::get('/captain', 'HomeController@captain')->name('captain');
    Route::get('/muatan', 'HomeController@muatan')->name('muatan');
    // Route::get('/laporan/excel', 'HomeController@laporan_excel')->name('laporan_excel');
    
    Route::put('/transaksi/update/{id}', 'HomeController@transaksi_update')->name('transaksi.update');
    Route::put('/muatan/update/{id}', [App\Http\Controllers\HomeController::class, 'muatan_update'])->name('muatan.update');
    Route::put('/kapal/update/{id}', [App\Http\Controllers\HomeController::class, 'kapal_update'])->name('kapal.update');
    Route::put('/captain/update/{id}', 'HomeController@captain_update')->name('captain.update');
    Route::put('/rute/update/{id}', [App\Http\Controllers\HomeController::class, 'rute_update'])->name('rute.update');
    
    Route::delete('/user/delete/{id}', 'HomeController@user_delete')->name('user.delete');
    Route::delete('/muatan/delete/{id}', [App\Http\Controllers\HomeController::class, 'muatan_delete'])->name('muatan.delete');
    Route::delete('/captain/delete/{id}', 'HomeController@captain_delete')->name('captain.delete');
    Route::delete('/kapal/delete/{id}', [App\Http\Controllers\HomeController::class, 'kapal_delete'])->name('kapal.delete');
    Route::delete('/rute/delete/{id}', [App\Http\Controllers\HomeController::class, 'rute_delete'])->name('rute.delete');
    
    Route::post('/password/update', 'HomeController@password_update')->name('password.update');
});

// KATEGORI
Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::get('/kategori', 'HomeController@kategori')->name('kategori');
    Route::put('/kategori/update/{id}', 'HomeController@kategori_update')->name('kategori.update');
    Route::post('/kategori/aksi', 'HomeController@kategori_aksi')->name('kategori.aksi');
    Route::delete('/kategori/delete/{id}', 'HomeController@kategori_delete')->name('kategori.delete');
});


// LAPORAN
Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::get('/laporan', 'HomeController@laporan')->name('laporan');
    Route::get('/laporan/pdf', 'HomeController@laporan_pdf')->name('laporan_pdf');
    Route::get('/laporan/print', 'HomeController@laporan_print')->name('laporan_print');
    Route::get('/laporan/input', 'HomeController@input_laporan')->name('input_laporan');
    Route::get('/laporan/income/{id}', 'HomeController@getIncomeData');
    Route::get('/laporan/update/{id}', 'HomeController@laporan_update_show')->name('laporan.update');
    Route::get('/laporan/pdf', [App\Http\Controllers\HomeController::class, 'laporan_pdf'])->name('laporan.pdf');
    
    Route::put('/laporan/update/{id}', 'HomeController@laporan_update')->name('laporan.edit');
    
    Route::post('/laporan', 'HomeController@laporan_create')->name('laporan.create');
});

Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::delete('/laporan/{id}/delete', 'HomeController@laporan_delete')->name('laporan.destroy');
});

// PENDAPATAN

Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::get('/data_pendapatan', 'HomeController@data_pendapatan')->name('data_pendapatan');
    Route::get('/pendapatan/input', 'HomeController@show_input_pendapatan')->name('input_pendapatan');
    Route::get('/pendapatan/{income_id}/edit', 'HomeController@show_edit_pendapatan')->name('edit_pendapatan');
    
    Route::put('/pendapatan/{income_id}', 'HomeController@update_pendapatan')->name('pendapatan.update');
    
    Route::post('/pendapatan/store', 'HomeController@input_pendapatan')->name('pendapatan.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/pendapatan/{income_id}/delete', 'HomeController@delete_pendapatan')->name('destroy_pendapatan');
    Route::delete('/pendapatan/{income_id}/spending/{spending_id}/delete', 'HomeController@delete_spending')->name('destroy_spending');
});

// USERS
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pengguna', 'HomeController@user')->name('user');
    Route::get('/pengguna/tambah', 'HomeController@user_add')->name('user.tambah');
    Route::get('/pengguna/edit/{id}', 'HomeController@user_edit')->name('user.edit');

    Route::put('/pengguna/update/{id}', 'HomeController@user_update')->name('user.update');
});

Route::middleware(['auth', 'role:admin,captain'])->group(function () {
    Route::delete('/transaksi/delete/{id}', 'HomeController@transaksi_delete')->name('transaksi.delete');
    Route::post('/muatan/aksi', [App\Http\Controllers\HomeController::class, 'muatan_aksi'])->name('muatan.aksi');
    Route::post('/password/update', 'HomeController@password_update')->name('password.update');
    Route::post('/rute/aksi', [App\Http\Controllers\HomeController::class, 'rute_aksi'])->name('rute.aksi');
    Route::post('/kapal/aksi', [App\Http\Controllers\HomeController::class, 'kapal_aksi'])->name('kapal.aksi');
    Route::post('/captain/aksi', 'HomeController@captain_aksi')->name('captain.aksi');
    Route::post('/pengguna/aksi', 'HomeController@user_aksi')->name('user.aksi');
    Route::post('/transaksi/aksi', 'HomeController@transaksi_aksi')->name('transaksi.aksi');
});


// Routes untuk rute (HomeController)

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/muatan/aksi', [App\Http\Controllers\HomeController::class, 'muatan_aksi'])->name('muatan.aksi');
    Route::post('/rute/aksi', [App\Http\Controllers\HomeController::class, 'rute_aksi'])->name('rute.aksi');
    Route::post('/kapal/aksi', [App\Http\Controllers\HomeController::class, 'kapal_aksi'])->name('kapal.aksi');
    Route::post('/captain/aksi', 'HomeController@captain_aksi')->name('captain.aksi');
    Route::post('/laporan', 'HomeController@laporan_create')->name('laporan.create');
    Route::post('/pengguna/aksi', 'HomeController@user_aksi')->name('user.aksi');
    Route::post('/transaksi/aksi', 'HomeController@transaksi_aksi')->name('transaksi.aksi');
});


