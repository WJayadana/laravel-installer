<?php

use Illuminate\Support\Facades\Route;
use Jayadana\WebInstaller\Livewire\Installer;


Route::get('install', Installer::class)->name('installer')
    ->middleware(['web']);

Route::get('/installed', function () {
    return view('web-installer::success');
})->name('installer.success')->middleware(['web', 'redirect.if.not.installed']);