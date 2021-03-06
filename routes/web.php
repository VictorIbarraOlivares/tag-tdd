<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tags = App\Models\Tag::all();
    return view('welcome', compact('tags'));
});

Route::post('tags', [App\Http\Controllers\TagController::class, 'store'])->name('tags.store');
Route::delete('tags/{tag}', [App\Http\Controllers\TagController::class, 'destroy']);