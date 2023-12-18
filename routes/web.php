<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserCarImageController;
use App\Http\Controllers\CarPropertiesController;
use App\Http\Controllers\UserCarPropertiesController;

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

Route::get('/', [CarController::class, 'index'])->name('index');

Route::prefix('cars')->name('cars')->group(function () {
    Route::get('', [CarController::class, 'index'])->name('.index');
    Route::prefix('{car}')->group(function () {
        Route::get('respond', [CarController::class, 'respond'])->name('.respond');
        Route::post('respond', [CarController::class, 'postResponse'])->name('.respond.post');
        Route::get('show', [CarController::class, 'show'])->name('.show');
    });
});

// LOGGED IN USERS
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USER
    Route::prefix('user')->name('user')->group(function () {

        // USER/CARS
        Route::prefix('cars')->name('.cars')->group(function () {
            Route::get('', [UserCarController::class, 'index']);
            Route::get('create', [UserCarController::class, 'create'])->name('.create');
            Route::post('store', [UserCarController::class, 'store'])->name('.store');

            // CAR
            Route::prefix('{car}')->group(function () {
                Route::get('info', [UserCarController::class, 'info'])->name('.info');
                Route::get('edit', [UserCarController::class, 'edit'])->name('.edit');
                Route::post('update', [UserCarController::class, 'update'])->name('.update');
                Route::get('delete', [UserCarController::class, 'delete'])->name('.delete');

                // CAR PROPERTIES
                Route::prefix('properties')->name('.properties')->group(function () {
                    Route::get('', [UserCarPropertiesController::class, 'show']);
                    Route::get('edit', [UserCarPropertiesController::class, 'edit'])->name('.edit');
                    Route::post('update', [UserCarPropertiesController::class, 'update'])->name('.update');
                });

                // CAR IMAGES
                Route::prefix('images')->name('.images')->group(function () {
                    Route::get('', [UserCarImageController::class, 'show']);
                    Route::get('edit', [UserCarImageController::class, 'edit'])->name('.edit');
                    Route::post('store', [UserCarImageController::class, 'store'])->name('.store');
                });
            });
        });
        // user routes
    });

    // ADMIN
    Route::prefix('dashboard')->name('dashboard')->middleware('admin')->group(function () {
        Route::get('', function () {
            return view('dashboard');
        });

        // CARS
        Route::prefix('cars')->name('.cars')->group(function () {
            Route::get('create', [CarController::class, 'create'])->name('.create');
            Route::post('store', [CarController::class, 'store'])->name('.store');
            Route::prefix('{car}')->group(function () {
                Route::get('info', [CarController::class, 'info'])->name('.info');
                Route::get('show', [CarController::class, 'show'])->name('.show');
                Route::get('edit', [CarController::class, 'edit'])->name('.edit');
                Route::post('update', [CarController::class, 'update'])->name('.update');
                Route::get('delete', [CarController::class, 'delete'])->name('.delete');

                // CAR IMAGES
                Route::prefix('images')->name('.images')->group(function () {
                    Route::get('', [CarImageController::class, 'show']);
                    Route::get('edit', [CarImageController::class, 'edit'])->name('.edit');
                    Route::post('store', [CarImageController::class, 'store'])->name('.store');
                });

                // CAR PROPERTIES
                Route::prefix('properties')->name('.properties')->group(function () {
                    Route::get('', [CarController::class, 'properties']);
                    Route::get('edit', [CarPropertiesController::class, 'edit'])->name('.edit');
                    Route::post('update', [CarPropertiesController::class, 'update'])->name('.update');
                });
            });
            Route::get('', [CarController::class, 'dashboard']);
        });

        // PROPERTIES
        Route::prefix('properties')->name('.properties')->group(function () {
            Route::get('', [PropertyController::class, 'dashboard']);
            Route::get('create', [PropertyController::class, 'create'])->name('.create');
            Route::post('store', [PropertyController::class, 'store'])->name('.store');
            Route::prefix('{property}')->group(function () {
                Route::get('edit', [PropertyController::class, 'edit'])->name('.edit');
                Route::post('update', [PropertyController::class, 'update'])->name('.update');
                Route::get('delete', [PropertyController::class, 'delete'])->name('.delete');
            });
        });

        // BRANDS
        Route::prefix('brands')->name('.brands')->group(function () {
            Route::get('', [BrandController::class, 'dashboard']);
            Route::get('create', [BrandController::class, 'create'])->name('.create');
            Route::post('store', [BrandController::class, 'store'])->name('.store');
            Route::prefix('{brand}')->group(function () {
                Route::get('edit', [BrandController::class, 'edit'])->name('.edit');
                Route::post('update', [BrandController::class, 'update'])->name('.update');
                Route::get('delete', [BrandController::class, 'delete'])->name('.delete');
            });
        });

        // USERS
        Route::prefix('users')->name('.users')->group(function () {
            Route::get('', [UserController::class, 'dashboard']);
            Route::get('create', [UserController::class, 'create'])->name('.create');
            Route::post('store', [UserController::class, 'store'])->name('.store');

            // USER
            Route::prefix('{user}')->group(function () {
                Route::get('edit', [UserController::class, 'edit'])->name('.edit');
                Route::post('update', [UserController::class, 'update'])->name('.update');
                Route::get('delete', [UserController::class, 'delete'])->name('.delete');
            });
        });
        // Route::get('cars', [CarController::class, 'show'])->name('.show');
    })->middleware('admin');
});

require __DIR__ . '/auth.php';
