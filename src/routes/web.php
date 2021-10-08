<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'history',
        'as' => 'history',
        'namespace' => 'Olegsv\History\Controllers',
    ], function() {
    Route::get('/', HistoryIndexController::class)->name('.index');

});
