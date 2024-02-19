<?php

use Abedin\WebInstaller\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Abedin\WebInstaller\Controllers\RequirementController;

Route::group(['prefix' => 'install', 'as' => 'installer.', 'middleware' => ['web']], function () {
    // welcome page routes here
    Route::controller(WelcomeController::class)->group(function(){
        Route::get('/', 'index')->name('welcome.index');
        Route::get('/publish-config', 'publishConfig')->name('publish-config');
    });

    // requirement check page routes here
    Route::controller(RequirementController::class)->group(function(){
        Route::get('/check-requirments', 'index')->name('requerment.index');
    });
});
