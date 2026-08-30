<?php

declare(strict_types=1);

namespace App\DTOs;

class Charger
{
    public function __construct(
        public string $id,
        public string $uuid,
        public string $provider,
        public string $model,
        public string $serial_number,
        public string $kwh,
        public string $charge_time_limit,
        public string $created_at,
        public string $currency,
        public int $price_per_kwh,
        public float $vat,
        public ?string $notes,
        public Location $location,
        public string $title,
        public bool $is_enabled,
        public string $country_code,
    ) {}
}
