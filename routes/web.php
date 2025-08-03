<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ai-form', [AIController::class, 'showForm'])->name('ai.form');
Route::post('/ai-generate', [AIController::class, 'generate'])->name('ai.generate');