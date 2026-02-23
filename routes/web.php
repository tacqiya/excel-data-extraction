<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [ExcelController::class, 'showUploadForm'])->name('excel.upload');
Route::post('/upload', [ExcelController::class, 'upload'])->name('excel.upload.post');
Route::get('/data', [ExcelController::class, 'showData'])->name('excel.data');
Route::post('/export', [ExcelController::class, 'export'])->name('excel.export');
