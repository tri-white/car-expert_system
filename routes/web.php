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
Route::get('/malfunctions/create', [MalfunctionsController::class, 'create'])->name('malfunctions.create');
Route::post('/malfunctions', [MalfunctionsController::class, 'store'])->name('malfunctions.store');
Route::get('/malfunctions/{malfunction}/edit', [MalfunctionsController::class, 'edit'])->name('malfunctions.edit');
Route::put('/malfunctions/{malfunction}', [MalfunctionsController::class, 'update'])->name('malfunctions.update');
Route::delete('/malfunctions/{malfunction}', [MalfunctionsController::class, 'destroy'])->name('malfunctions.destroy');

Route::get('/symptoms', [SymptomsController::class, 'index'])->name('symptoms');
Route::post('/symptoms/add', [SymptomsController::class, 'add'])->name('add-symptom');
Route::get('/symptoms/edit/{id}', [SymptomsController::class, 'edit'])->name('edit-symptom');
Route::post('/symptoms/update/{id}', [SymptomsController::class, 'update'])->name('update-symptom');
Route::get('/symptoms/delete/{id}', [SymptomsController::class, 'destroy'])->name('delete-symptom');
