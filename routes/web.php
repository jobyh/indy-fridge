<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'search')->name('search');

Route::view('/qr', 'qr')->name('qr');

Route::get('/menu', function () {
    return Pdf::loadView('list')->stream('take-out-cans.pdf');
})->name('list.pdf');
