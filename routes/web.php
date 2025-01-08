<?php

use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\CountryListController;
use App\Http\Controllers\NaturalPersonController;
use App\Http\Controllers\ProfessionController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


//Route::post('/language-switch', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('setLocale');

Route::get('/', [NaturalPersonController::class,'dbSchema'])->name('dbSchema');
Route::post('/database-config', [NaturalPersonController::class, 'saveDatabaseConfig'])->name('database.config.save');

Route::resource('/natural-person', NaturalPersonController::class)->names('natural-person');
//IMPORT
Route::get('/import-natural-person', [NaturalPersonController::class,'import'])->name('natural-person.import');
Route::post('/import-natural-person', [NaturalPersonController::class,'importNaturalPerson'])->name('natural-person.import.post');
