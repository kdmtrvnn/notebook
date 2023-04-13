<?php

use App\Http\Controllers\NotebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'notebooks'], function () {
        Route::get('/', [NotebookController::class, 'get'])
            ->name('notebooks.get');

        Route::get('/store', [NotebookController::class, 'showViewStore'])
            ->name('notebooks.get_view_create');

        Route::get('/{id}', [NotebookController::class, 'show'])
            ->name('notebooks.show');

        Route::post('/', [NotebookController::class, 'store'])
            ->name('notebooks.store');

        Route::post('/{id}', [NotebookController::class, 'update'])
            ->name('notebooks.update');
    });
});
