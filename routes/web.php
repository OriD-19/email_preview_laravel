<?php

use App\Http\Controllers\PreviewEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/v1/email/preview', [PreviewEmailController::class, 'show']);