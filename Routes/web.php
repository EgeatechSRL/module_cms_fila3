<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use Modules\Cms\Filament\Front\Pages\Welcome;

// Route::get('/{lang?}/{container0?}', '\\' . Welcome::class)->name('test');

Route::resource('{container0}/{item0?}/{container1?}/{item1?}/{container2?}/{item2?}', PageController::class);
