<?php

declare(strict_types=1);

use App\Http\Middleware\SetDefaultTenant;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByPath::class,
    SetDefaultTenant::class,
    // PreventAccessFromCentralDomains::class,
])->prefix('/{tenant}/')->group(function () {

    Route::get('/', function () {

        return Inertia::render('welcome');
    })->name('home');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', function () {
            return Inertia::render('dashboard');
        })->name('dashboard');
    });

    require __DIR__.'/settings.php';
    require __DIR__.'/auth.php';
});
