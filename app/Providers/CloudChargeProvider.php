<?php

declare(strict_types=1);

namespace App\Providers;

use App\DTOs\Charger;
use App\DTOs\Location;
use App\Exceptions\ChargerNotFoundException;
use App\Providers\ChargerProvider;
use App\DTOs\CloudChargeResponse;
use App\Support\CountryCode;
use Illuminate\Support\Facades\Http;

class CloudChargeProvider implements ChargerProvider
{
    public function getCharger(int $chargerId): Charger
    {
        
        $response = Http::get(
            "https://pair.mosquitodesign.net/api/work-sample/chargers/cloudcharge/{$chargerId}"
        );
            
        if ($response->notFound()) {
            throw new ChargerNotFoundException();
        }

        $response->throw();

        $cloudChargeResponse = CloudChargeResponse::fromArray(
            $response->json()
        );

        return new Charger(
            id: $cloudChargeResponse->id,
            uuid: $cloudChargeResponse->uuid,
            provider: 'CloudCharge',
            model: $cloudChargeResponse->model,
            serial_number: $cloudChargeResponse->serial_number,
            kwh: $cloudChargeResponse->kwh,
            charge_time_limit: $cloudChargeResponse->charge_time_limit_in_hours,
            created_at: $cloudChargeResponse->created_at,
            currency: $cloudChargeResponse->currency,
            price_per_kwh: (int) round($cloudChargeResponse->price_per_kwh * 100),
            vat: (float) $cloudChargeResponse->vat,
            notes: $cloudChargeResponse->notes,
            location: $cloudChargeResponse->location,
            title: $cloudChargeResponse->name,
            is_enabled: $cloudChargeResponse->enabled,
            country_code: CountryCode::fromName($cloudChargeResponse->country),
        );
    }
}