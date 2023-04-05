<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->group(function () {
   Route::post('/',[\App\Http\Controllers\TasksController::class,'store'])->name('tasks.store');
   Route::get('/edit/{slug}',[\App\Http\Controllers\TasksController::class,'edit'])->name('tasks.edit');
   Route::put('/update/{slug}',[\App\Http\Controllers\TasksController::class,'update'])->name('tasks.update');
   Route::delete('/delete/{slug}',[\App\Http\Controllers\TasksController::class,'delete'])->name('tasks.delete');
});
