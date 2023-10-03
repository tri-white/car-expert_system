<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ConfigureController;

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

Route::get('/symptoms', [ConfigureController::class, 'symptoms'])->name('symptoms');
Route::get('/malfunctions', [ConfigureController::class, 'malfunctions'])->name('malfunctions');

Route::post('/symptoms/add', [ConfigureController::class, 'storeSymptom'])->name('add-symptom');
Route::get('/symptoms/edit/{id}', [ConfigureController::class, 'editSymptom'])->name('edit-symptom');
Route::post('/symptoms/update/{id}', [ConfigureController::class, 'editSymptom'])->name('update-symptom');
Route::get('/symptoms/delete/{id}', [ConfigureController::class, 'destroySymptom'])->name('delete-symptom');
