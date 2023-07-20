<?php


use App\Http\Controllers\Api\v1\Admin\AdminController;


Route::group([
    'controller' => AdminController::class,
    'as' => 'admin.'
], function () {
    Route::get('/check', 'check')->name('check');

});


