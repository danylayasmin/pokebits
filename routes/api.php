<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\EvolutionChainController;
use App\Http\Controllers\EncounterAreasController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MoveController;
use App\Http\Controllers\AbilityController;
use App\Http\Controllers\HabitatController;
use App\Http\Controllers\TypeController;

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
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/pokemon',
        [PokemonController::class, 'index']
    )->name('pokemon.index');

    Route::get('/pokemon/{id}', [PokemonController::class, 'getById'])
        ->where('id', '[0-9]+')
        ->name('pokemon.id');

    Route::get('/pokemon/{name}', [PokemonController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('pokemon.name');

    Route::post(
        '/pokemon',
        [PokemonController::class, 'store']
    )->name('pokemon.store');

    Route::put(
        '/pokemon/{pokemon}',
        [PokemonController::class, 'update']
    )->name('pokemon.update');

    Route::delete(
        '/pokemon/{pokemon}',
        [PokemonController::class, 'destroy']
    )->name('pokemon.destroy');
});

// Species routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/species',
        [SpeciesController::class, 'index']
    )->name('species.index');

    Route::get('/species/{name}', [SpeciesController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('species.name');

    Route::post(
        '/species',
        [SpeciesController::class, 'store']
    )->name('species.store');

    Route::put(
        '/species/{species}',
        [SpeciesController::class, 'update']
    )->name('species.update');

    Route::delete(
        '/species/{species}',
        [SpeciesController::class, 'destroy']
    )->name('species.destroy');
});

// Evolution chain routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/evolution-chain',
        [EvolutionChainController::class, 'index']
    )->name('evolution-chain.index');

    Route::get('/evolution-chain/{id}', [EvolutionChainController::class, 'getById'])
        ->where('id', '[0-9]+')
        ->name('evolution-chain.id');

    Route::post(
        '/evolution-chain',
        [EvolutionChainController::class, 'store']
    )->name('evolution-chain.store');

    Route::put(
        '/evolution-chain/{evolutionChain}',
        [EvolutionChainController::class, 'update']
    )->name('evolution-chain.update');

    Route::delete(
        '/evolution-chain/{id}',
        [EvolutionChainController::class, 'destroy']
    )->name('evolution-chain.destroy');
});

// Encounter areas routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function (){
    Route::get(
        '/encounter-area',
        [EncounterAreasController::class, 'index']
    )->name('encounter-area.index');

    Route::get('/encounter-area/{area_name}', [EncounterAreasController::class, 'getByName'])
        ->where('area_name', '[a-zA-Z\-]+')
        ->name('encounter-area.name');

    Route::post(
        '/encounter-area',
        [EncounterAreasController::class, 'store']
    )->name('encounter-area.store');

    Route::put(
        '/encounter-area/{encounterAreas}',
        [EncounterAreasController::class, 'update']
    )->name('encounter-area.update');

    Route::delete(
        '/encounter-area/{encounterAreas}',
        [EncounterAreasController::class, 'destroy']
    )->name('encounter-area.destroy');
});

// Items routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/item',
        [ItemController::class, 'index']
    )->name('item.index');

    Route::get('/item/{name}', [ItemController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('item.name');

    Route::post(
        '/item',
        [ItemController::class, 'store']
    )->name('item.store');

    Route::put(
        '/item/{id}',
        [ItemController::class, 'update']
    )->name('item.update');

    Route::delete(
        '/item/{id}',
        [ItemController::class, 'destroy']
    )->name('item.destroy');
});

// Moves routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/move',
        [MoveController::class, 'index']
    )->name('move.index');

    Route::get('/move/{name}', [MoveController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('move.name');

    Route::post(
        '/move',
        [MoveController::class, 'store']
    )->name('move.store');

    Route::put(
        '/move/{move}',
        [MoveController::class, 'update']
    )->name('move.update');

    Route::delete(
        '/move/{move}',
        [MoveController::class, 'destroy']
    )->name('move.destroy');
});

// Abilities routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/ability',
        [AbilityController::class, 'index']
    )->name('ability.index');

    Route::get('/ability/{name}', [AbilityController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('ability.name');

    Route::post(
        '/ability',
        [AbilityController::class, 'store']
    )->name('ability.store');

    Route::put(
        '/ability/{ability}',
        [AbilityController::class, 'update']
    )->name('ability.update');

    Route::delete(
        '/ability/{ability}',
        [AbilityController::class, 'destroy']
    )->name('ability.destroy');
});

// Habitats routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/habitat',
        [HabitatController::class, 'index']
    )->name('habitat.index');

    Route::get('/habitat/{name}', [HabitatController::class, 'getByName'])
        ->where('name', '[a-zA-Z\-]+')
        ->name('habitat.name');

    Route::post(
        '/habitat',
        [HabitatController::class, 'store']
    )->name('habitat.store');

    Route::put(
        '/habitat/{habitat}',
        [HabitatController::class, 'update']
    )->name('habitat.update');

    Route::delete(
        '/habitat/{habitat}',
        [HabitatController::class, 'destroy']
    )->name('habitat.destroy');
});

// Types routes
Route::middleware(['throttle:pokemon', 'cache'])->group(function () {
    Route::get(
        '/type',
        [TypeController::class, 'index']
    )->name('type.index');

    Route::get('/type/{name}', [TypeController::class, 'getByName'])
        ->where('name', '[a-zA-Z]+')
        ->name('type.name');

    Route::post(
        '/type',
        [TypeController::class, 'store']
    )->name('type.store');

    Route::put(
        '/type/{id}',
        [TypeController::class, 'update']
    )->name('type.update');

    Route::delete(
        '/type/{id}',
        [TypeController::class, 'destroy']
    )->name('type.destroy');
});
