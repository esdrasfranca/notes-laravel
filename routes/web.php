<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);

// Main routes
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/new-note', [MainController::class, 'newNote'])->name('new');
    Route::post('/new-note-submit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/edit-note/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/edit-note-submit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');
    Route::get('/delete-note/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/logout', [AuthController::class, 'logout']);
});
