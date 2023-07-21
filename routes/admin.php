<?php


use App\Http\Controllers\Api\v1\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;


Route::group([
    'controller' => AdminController::class,
    'as' => 'admin.',
    'middleware' => AdminMiddleware::class
], function () {
    Route::get('/check', 'check')->name('check');
});


