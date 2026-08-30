<?php

declare(strict_types=1);

namespace App\DTOs;

class GreenFluxResponse
{
    public function __construct(
        public string $id,
        public string $model,
        public string $kwh,
        public ?string $comment,
        public int $maxChargeMinutes,
        public string $created,
        public string $serialNumber,
        public GreenFluxPrice $price,
        public string $location,
        public string $country,
        public bool $active,
        public string $internalId,
        public string $title,
        public bool $is_enabled,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            model: $data['model'],
            kwh: $data['kwh'],
            comment: $data['comment'] ?? null,
            maxChargeMinutes: (int) $data['maxChargeMinutes'],
            created: $data['created'],
            serialNumber: $data['serialNumber'],
            price: GreenFluxPrice::fromArray($data['price']),
            location: $data['location'],
            country: $data['country'],
            active: $data['active'],
            internalId: $data['internalId'],
            title: $data['title'],
            is_enabled: $data['is_enabled'],
        );
    }
}