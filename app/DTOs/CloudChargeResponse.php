<?php

declare(strict_types=1);

namespace App\DTOs;

class CloudChargeResponse
{
    public function __construct(
        public string $id,
        public string $uuid,
        public string $model,
        public string $name,
        public string $serial_number,
        public string $kwh,
        public string $charge_time_limit_in_hours,
        public string $created_at,
        public string $currency,
        public float $price_per_kwh,
        public float $vat,
        public ?string $notes,
        public Location $location,
        public bool $enabled,
        public string $country,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            model: $data['model'],
            name: $data['name'],
            serial_number: $data['serial_number'],
            kwh: $data['kwh'],
            charge_time_limit_in_hours: $data['charge_time_limit_in_hours'],
            created_at: $data['created_at'],
            currency: $data['currency'],
            price_per_kwh: $data['price_per_kwh'],
            vat: $data['vat'],
            notes: $data['notes'] ?? null,
            location: new Location(
                latitude: (float) $data['location']['lat'],
                longitude: (float) $data['location']['long'],
            ),
            enabled: $data['enabled'],
            country: $data['country'],
        );
    }
}