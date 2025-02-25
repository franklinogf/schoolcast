<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->name('central.')->group(function () {
        Route::get('/', function () {

            return redirect()->to('/admin');
        })->name('home');
    });
}
