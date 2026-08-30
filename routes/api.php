<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChargerController;

Route::get(
    '/chargers/{provider}/{chargerId}',
    [ChargerController::class, 'show']
)->whereNumber('chargerId');
