<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ConfigureController;
use App\Http\Controllers\MalfunctionsController;
use App\Http\Controllers\SymptomsController;



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
    return view('welcome');
})->name('welcome');

Route::get('/diagnose', [DiagnosticController::class, 'index'])->name('diagnose');
Route::post('/diagnose', [DiagnosticController::class, 'diagnose']);

Route::get('/results', [DiagnosticController::class, 'results'])->name('results');

Route::get('/configure', [ConfigureController::class, 'index'])->name('configure');


Route::get('/malfunctions', [MalfunctionsController::class, 'index'])->name('malfunctions');
Route::post('/malfunctions/add', [MalfunctionsController::class, 'add'])->name('add-malfunction');
Route::get('/malfunctions/edit/{id}', [MalfunctionsController::class, 'edit'])->name('edit-malfunction');
Route::post('/malfunctions/update/{id}', [MalfunctionsController::class, 'update'])->name('update-malfunction');
Route::get('/malfunctions/delete/{id}', [MalfunctionsController::class, 'destroy'])->name('destroy-malfunction');

Route::get('/symptoms', [SymptomsController::class, 'index'])->name('symptoms');
Route::post('/symptoms/add', [SymptomsController::class, 'add'])->name('add-symptom');
Route::get('/symptoms/edit/{id}', [SymptomsController::class, 'edit'])->name('edit-symptom');
Route::post('/symptoms/update/{id}', [SymptomsController::class, 'update'])->name('update-symptom');
Route::get('/symptoms/delete/{id}', [SymptomsController::class, 'destroy'])->name('delete-symptom');
