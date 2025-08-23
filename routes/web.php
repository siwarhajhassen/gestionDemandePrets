<?php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/agriculteurs/demande', [AgriculteurController::class, 'create'])
        ->name('agriculteurs.create');

    Route::post('/agriculteurs/demande', [AgriculteurController::class, 'store'])
        ->name('agriculteurs.store');
});
