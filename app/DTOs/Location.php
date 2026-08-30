<?php

declare(strict_types=1);

namespace App\DTOs;

class Location
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}

    public static function fromString(string $coordinates): self
    {
        [$latitude, $longitude] = array_map('trim', explode(',', $coordinates));

        return new self(
            latitude: (float) $latitude,
            longitude: (float) $longitude,
        );
    }

    public function toArray(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
