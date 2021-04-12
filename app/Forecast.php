<?php


namespace App;

use Illuminate\Support\Carbon;

class Forecast
{
    public function __construct(
        public Carbon $date,
        public float $temp_min, // Kelvin
        public float $temp_max, // Kelvin
        public string $weather, // e.g. "Cloudy"
        // @todo add more fields as needed
    ){}
}
