<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidProviderException extends Exception
{
    public function __construct(string $provider)
    {
        parent::__construct("Invalid provider: $provider");
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], 400);
    }
}