<?php

use App\Http\Controllers\PreviewEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/v1/csrf_token', function () {
        return csrf_token();
});

Route::post('/api/v1/email/preview', [PreviewEmailController::class, 'show']);
