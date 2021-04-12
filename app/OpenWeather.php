<?php
namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

// @todo add an interface to allow swapping out the API
class OpenWeather
{
    private const ENDPOINT = 'http://api.openweathermap.org/data/2.5/forecast?id=524901&appid=';

    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getForecastsForCity(string $city_id): Collection
    {
        $response = Http::get(self::ENDPOINT.$this->key. '&id='.$city_id);

        return collect( json_decode($response->body())->list )->map(fn($data) => $this->forecastFromObject($data));
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
}
