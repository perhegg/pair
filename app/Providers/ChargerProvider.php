<?php

declare(strict_types=1);

namespace App\Providers;

use App\DTOs\Charger;

interface ChargerProvider
{
    public function getCharger(int $chargerId): Charger;
}