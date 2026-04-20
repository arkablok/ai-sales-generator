<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesPageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sales/create', [SalesPageController::class, 'create'])->name('sales.create');
    Route::post('/sales/generate', [SalesPageController::class, 'generate'])->name('sales.generate');
    Route::get('/sales/edit/{salesPage}', [SalesPageController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/update/{salesPage}', [SalesPageController::class, 'update'])->name('sales.update');
    Route::get('/sales/preview/{salesPage}', [SalesPageController::class, 'preview'])->name('sales.preview');
    Route::get('/sales/history', [SalesPageController::class, 'history'])->name('sales.history');
    Route::delete('/sales/{salesPage}', [SalesPageController::class, 'destroy'])->name('sales.destroy');
    Route::post('/sales/regenerate/{salesPage}', [SalesPageController::class, 'regenerate'])->name('sales.regenerate');
    Route::get('/sales/export/{salesPage}', [SalesPageController::class, 'export'])->name('sales.export');

    Route::get('/render-html/{id}', function($id) {
    $page = App\Models\SalesPage::findOrFail($id);
    if ($page->user_id != auth()->id()) abort(403);
    return response($page->generated_output, 200)->header('Content-Type', 'text/html');
})->name('render.html');
});

require __DIR__.'/auth.php';
