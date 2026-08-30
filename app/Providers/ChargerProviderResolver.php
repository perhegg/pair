<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\InvalidProviderException;

class ChargerProviderResolver
{
    public static function resolve(string $provider): ChargerProvider
    {
        return match ($provider) {
            'cloudcharge' => new CloudChargeProvider(),
            'greenflux' => new GreenFluxProvider(),
            default => throw new InvalidProviderException($provider),
        };
    }
}