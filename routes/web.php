<?php

use Illuminate\Support\Facades\Route;
use Ibrah\LaravelLogViewer\Http\Controllers\LogViewerController;

Route::group([
    'prefix' => config('log-viewer.route_prefix', 'logs'),
    'middleware' => array_merge(config('log-viewer.middleware', ['web', 'auth']), ['log-viewer.authorize', 'log-viewer.locale']),
    'as' => 'log-viewer.',
], function () {
    Route::get('/', [LogViewerController::class, 'index'])->name('index');
    Route::get('/show/{id}', [LogViewerController::class, 'show'])->name('show');
    Route::post('/clear', [LogViewerController::class, 'clear'])->name('clear');
    Route::get('/download', [LogViewerController::class, 'download'])->name('download');
    Route::post('/set-locale', [LogViewerController::class, 'setLocale'])->name('set-locale');
});
