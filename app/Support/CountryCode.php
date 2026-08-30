<?php

declare(strict_types=1);

namespace App\Support;

class CountryCode
{
    public const DEFAULT = 'SE';

    private const CODES = [
        'SWEDEN' => 'SE',
        'ENGLAND' => 'GB',
        // Plus other countries. 
    ];

    public static function fromName(?string $country): string
    {
        $normalised = strtoupper(trim((string) $country));

        if ($normalised === '') {
            return self::DEFAULT;
        }

        if (in_array($normalised, self::CODES, true)) {
            return $normalised;
        }

        return self::CODES[$normalised] ?? self::DEFAULT;
    }
}