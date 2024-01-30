<?php

use App\Http\Controllers\Chirp;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// DB::listen(function ($query){
//     dump($query->sql);
// });

Route::get('/', function () {
    return view('welcome');
});
/******** Route::get('/chirps/{chrip?}', function ($chirp = null) {
    if ($chirp === '2') { return redirect ('/chirps'); }
    return 'Bienvenido a Chirps ' . $chirp;
});  ******/
Route::middleware('auth')->group(function () {
    /**** MOVEMOS LAS RUTAS QUE TENIAMOS FUERA DEL 'AUTH' PARA SIMPLIFICAR 
        EL CODIGO COMO LAS RUTAS dashboad y chirps ****/
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //RUTAS LLAMADAS PARA EL SISTEMA DE BLOG
    Route::get('/chirps', [App\Http\Controllers\ChirpController::class, 'index'])
        ->name('chirps.index');
    Route::post('/chirps', [App\Http\Controllers\ChirpController::class, 'store'])
        ->name('chirps.store');
    Route::get('/chirps/{chirp}/edit', [App\Http\Controllers\ChirpController::class, 'edit'])
        ->name('chirps.edit');
    Route::put('/chirps/{chirp}', [App\Http\Controllers\ChirpController::class, 'update'])
        ->name('chirps.update');
    Route::delete('/chirps/{chirp}', [App\Http\Controllers\ChirpController::class, 'destroy'])
    ->name('chirps.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
