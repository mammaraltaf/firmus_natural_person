<?php

use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\CountryListController;
use App\Http\Controllers\NaturalPersonController;
use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\Route;


Route::resource('/', NaturalPersonController::class);
//Route::resource('professions', ProfessionController::class);
//Route::resource('civil-statuses', CivilStatusController::class);
//Route::resource('country-lists', CountryListController::class);
