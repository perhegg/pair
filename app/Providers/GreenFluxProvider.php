<?php

declare(strict_types=1);

namespace App\Providers;

use App\DTOs\Charger;
use App\DTOs\Location;
use App\Exceptions\ChargerNotFoundException;
use App\Providers\ChargerProvider;
use App\DTOs\GreenFluxResponse;
use App\Support\CountryCode;
use Illuminate\Support\Facades\Http;

class GreenFluxProvider implements ChargerProvider
{
    public function getCharger(int $chargerId): Charger
    {
        $response = Http::get(
            "https://pair.mosquitodesign.net/api/work-sample/chargers/greenflux/{$chargerId}"
        );

        if ($response->notFound()) {
            throw new ChargerNotFoundException();
        }

        $response->throw();

        $greenFluxResponse = GreenFluxResponse::fromArray(
            $response->json()
        );

        return new Charger(
            id: $greenFluxResponse->id,
            uuid: $greenFluxResponse->internalId,
            provider: 'Greenflux',
            model: $greenFluxResponse->model,
            serial_number: $greenFluxResponse->serialNumber,
            kwh: $greenFluxResponse->kwh,
            charge_time_limit: (string) (
                $greenFluxResponse->maxChargeMinutes / 60
            ),
            created_at: $greenFluxResponse->created,
            currency: $greenFluxResponse->price->currency,
            price_per_kwh: (int) round((float) $greenFluxResponse->price->perKwh * 100),
            vat: (float) $greenFluxResponse->price->percentVat,
            notes: $greenFluxResponse->comment,
            location: Location::fromString($greenFluxResponse->location),
            title: $greenFluxResponse->title,
            is_enabled: $greenFluxResponse->is_enabled,
            country_code: CountryCode::fromName($greenFluxResponse->country),
        );
    }
}
