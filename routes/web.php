<?php

use App\Http\Controllers\PreviewEmailController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/v1/email/preview', [PreviewEmailController::class, 'show']);
