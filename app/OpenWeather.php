<?php
namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

// @todo add an interface to allow swapping out the API
class OpenWeather
{
    private const ENDPOINT = 'http://api.openweathermap.org/data/2.5/forecast?appid=';

    private string $key;

    public function __construct()
    {
        $this->key = config('services.openweather.key');
    }

    public function getForecastsForCityId(string $city_id, bool $one_per_day = true): Collection
    {
        $response = Http::get(self::ENDPOINT.$this->key. '&id='.$city_id);

        return collect( json_decode($response->body())->list )
            ->map(fn($data) => $this->forecastFromObject($data))
            ->when($one_per_day, fn($results) => $this->onePerDay($results));
    }

    public function getForecastsForCityName(string $city_name, bool $one_per_day = true): Collection
    {
        $response = Http::get(self::ENDPOINT.$this->key. '&q='.$city_name);

        return collect( json_decode($response->body())->list )
            ->map(fn($data) => $this->forecastFromObject($data))
            ->when($one_per_day, fn($results) => $this->onePerDay($results));
    }

    private function forecastFromObject(object $data): Forecast
    {
        return new Forecast(
            date: Carbon::create($data->dt_txt),
            temp_min: $data->main->temp_min,
            temp_max: $data->main->temp_max,
            weather: $data->weather[0]->main,
            // @todo add more fields as needed
        );
    }

    private function onePerDay(Collection $results): Collection
    {
        return $results->filter(static function(Forecast $forecast, int $key) use ($results) {
            return $key === 0 ||
                ! $forecast->date->isSameDay( $results[--$key]->date );
        });
    }
}
