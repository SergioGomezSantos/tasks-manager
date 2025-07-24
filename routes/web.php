<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\TaskShow;
use Illuminate\Support\Facades\Route;
use App\Livewire\Tasks\TasksIndex;

Route::get('/', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('tasks');

Route::get('/{slug}', TaskShow::class)->name('tasks.show');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
