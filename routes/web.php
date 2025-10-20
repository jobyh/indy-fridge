<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'search')->name('search');
Route::view('/qr', 'qr')->name('qr');
