<?php

namespace App\Service;

class GeoService
{
    public const EARTH_RADIUS = 6371;

    public function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $factor = pi() / 180;
        $firstStep = 0.5 - cos(($lat2 - $lat1) * $factor) / 2 +
            cos($lat1 * $factor) * cos($lat2 * $factor) *
            (1 - cos(($lon2 - $lon1) * $factor)) / 2;
        return 2 * self::EARTH_RADIUS * asin(sqrt($firstStep));
    }
}
