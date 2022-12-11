<?php

namespace App\Service;

class GeoService
{
    public const EARTH_RADIUS = 6371;

    public function calculateDistance(float $firstLatitude, float $firstLongitude, float $secondLatitude, float $secondLongitude): float
    {
        $factor = pi() / 180;
        $firstStep = 0.5 - cos(($secondLatitude - $firstLatitude) * $factor) / 2 +
            cos($firstLatitude * $factor) * cos($secondLatitude * $factor) * (1 - cos(($secondLongitude - $firstLongitude) * $factor)) / 2;
        return 2 * self::EARTH_RADIUS * asin(sqrt($firstStep));
    }
}
