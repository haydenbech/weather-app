<?php


namespace App;

use Illuminate\Support\Carbon;

// @todo add temperature conversion
class Forecast
{
    public function __construct(
        public Carbon $date,
        public float $temp_min, // Kelvin
        public float $temp_max, // Kelvin
        public string $weather, // e.g. "Cloudy"
        // @todo add more fields as needed
    ){}

    public function __toString(): string {
        return implode("\n",[
            $this->date->toDateString(),
            $this->weather,
            'Min: '.$this->temp_min.'K',
            'Max: '.$this->temp_max.'K',
        ]);
    }
}
