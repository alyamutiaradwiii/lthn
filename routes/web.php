<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index')->middleware('auth');
Route::get('/buku/input', [BukuController::class, 'input'])->name('buku.input');
Route::post('/buku/create', [BukuController::class, 'store'])->name('buku.create');
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/data-buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

//login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

//export pdf
Route::get('/export_pdf_buku', [BukuController::class, 'export_pdf'])->name('export_pdf_buku');
Route::get('/export_excel_buku', [BukuController::class, 'export_excel'])->name('export_excel_buku');
Route::post('/import_excel_buku', [BukuController::class, 'import_excel'])->name('import_excel_buku');