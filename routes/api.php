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
        [PokemonController::class, 'getById']
    )->name('pokemon.id');
    
    Route::get(
        '/pokemon/{name}',
        [PokemonController::class, 'getByName']
    )->name('pokemon.name');

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
Route::middleware(['throttle:pokemon'])->group(function () {
    Route::get(
        '/species',
        [SpeciesController::class, 'index']
    )->name('species.index');

    Route::get(
        '/species/{id}',
        [SpeciesController::class, 'getById']
    )->name('species.id');

    Route::get(
        '/species/{name}',
        [SpeciesController::class, 'getByName']
    )->name('species.name');

    Route::post(
        '/species',
        [SpeciesController::class, 'store']
    )->name('species.store');

    Route::put(
        '/species/{id}',
        [SpeciesController::class, 'update']
    )->name('species.update');

    Route::delete(
        '/species/{id}',
        [SpeciesController::class, 'destroy']
    )->name('species.destroy');
});

// Evolution chain routes
Route::middleware(['throttle:pokemon'])->group(function () {
    Route::get(
        '/evolution-chain',
        [EvolutionChainController::class, 'index']
    )->name('evolution-chain.index');

    Route::get(
        '/evolution-chain/{id}',
        [EvolutionChainController::class, 'getById']
    )->name('evolution-chain.id');

    Route::get(
        '/evolution-chain/{name}',
        [EvolutionChainController::class, 'getByName']
    )->name('evolution-chain.name');

    Route::post(
        '/evolution-chain',
        [EvolutionChainController::class, 'store']
    )->name('evolution-chain.store');

    Route::put(
        '/evolution-chain/{id}',
        [EvolutionChainController::class, 'update']
    )->name('evolution-chain.update');

    Route::delete(
        '/evolution-chain/{id}',
        [EvolutionChainController::class, 'destroy']
    )->name('evolution-chain.destroy');
});

// Encounter areas routes
Route::middleware(['throttle:pokemon'])->group(function (){

})

// Items routes
// Moves routes
// Abilities routes
// Habitats routes
// Types routes
