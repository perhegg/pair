# Pair EV Charger API

A microservice that fetches an EV charger from a provider and returns it in a
standardised format.

Two providers are supported: **CloudCharge** and **GreenFlux**. Each returns a
different shape, so every provider has its own client that maps the response
onto a single `Charger` DTO.

## Requirements

- PHP 8.3+
- Composer

No database and no Node.js.

## Getting started

```bash
composer install
php artisan serve
```

The service runs at http://localhost:8000.

## Usage

```
GET /api/chargers/{provider}/{chargerId}
```

`{provider}` is `cloudcharge` or `greenflux`.

```bash
curl http://localhost:8000/api/chargers/greenflux/1
```

```json
{
    "id": "1",
    "uuid": "550e8400-e29b-41d4-a716-446655440000",
    "provider": "Greenflux",
    "model": "G0001",
    "serial_number": "GRE01ST",
    "kwh": "22",
    "charge_time_limit": "2",
    "created_at": "2026-01-16",
    "currency": "SEK",
    "price_per_kwh": 595,
    "vat": 0.25,
    "notes": "Standard EV charger",
    "location": {
        "latitude": 59.34105507785056,
        "longitude": 18.048966780063736
    },
    "title": "Stockholm Gamla Stan",
    "is_enabled": true,
    "country_code": "SE"
}
```

An unknown charger returns `404`:

```bash
curl http://localhost:8000/api/chargers/greenflux/2
```

```json
{
    "message": "Charger not found."
}
```
