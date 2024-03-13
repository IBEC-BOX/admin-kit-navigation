<?php

use Illuminate\Support\Facades\Route;
use RyanChandler\FilamentNavigation\UI\API\Controllers\NavigationController;

Route::get('/navigations', [NavigationController::class, 'index']);
Route::get('/navigations/{handle}', [NavigationController::class, 'show']);
