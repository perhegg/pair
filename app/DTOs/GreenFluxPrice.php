<?php

declare(strict_types=1);

namespace App\DTOs;

class GreenFluxPrice
{
    public function __construct(
        public string $currency,
        public float $perKwh,
        public float $percentVat,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            perKwh: (float) $data['perKwh'],
            percentVat: (float) $data['percentVat'],
        );
    }
}