<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Providers\ChargerProviderResolver;
use Illuminate\Http\JsonResponse;

class ChargerController
{
    public function show(string $provider, string $chargerId): JsonResponse
    {
        $chargerProvider = ChargerProviderResolver::resolve($provider);
        $charger = $chargerProvider->getCharger((int) $chargerId);

        return response()->json($charger);
    }
}
