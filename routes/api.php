<?php

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
Route::prefix('axios')->group(function () {
   Route::get('fetch-tasks/{slug}', [\App\Http\Controllers\Api\AxiosController::class,'fetchTasks'])->name('axios.fetch.tasks');
   Route::post('update-tasks-priority', [\App\Http\Controllers\Api\AxiosController::class,'updateTaskPriority'])->name('axios.fetch.tasks.update.priority');
});
