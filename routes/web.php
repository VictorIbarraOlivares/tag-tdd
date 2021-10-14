<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tags = App\Models\Tag::get();
    return view('welcome', compact('tags'));
});
