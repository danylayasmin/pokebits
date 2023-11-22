<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For routes that return calls of the api, use `::middleware(['throttle:pokemon'])` to limit the number of calls to 150 per minute
// Pokemon routes
Route::middleware(['throttle:pokemon'])->group(function () {
    Route::get(
        '/pokemon',
        [PokemonController::class, 'index']
    )->name('pokemon.index');

    Route::get(
        '/pokemon/{id}',
        [PokemonController::class, 'show']
    )->name('pokemon.show');

    Route::post(
        '/pokemon',
        [PokemonController::class, 'store']
    )->name('pokemon.store');

    Route::put(
        '/pokemon/{id}',
        [PokemonController::class, 'update']
    )->name('pokemon.update');

    Route::delete(
        '/pokemon/{id}',
        [PokemonController::class, 'destroy']
    )->name('pokemon.destroy');
});

// Species routes
// Evolution chain routes
// Encounter areas routes
// Items routes
// Moves routes
// Abilities routes
// Habitats routes
// Types routes
