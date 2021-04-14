<?php

namespace Tests\Unit;

use App\Forecast;
use App\OpenWeather;
use Tests\TestCase;

class OpenWeatherTest extends TestCase
{
    /** @test */
    public function city_id_request_returns_forecasts(): void
    {
        $openWeather = new OpenWeather();

        $london = 2643743;
        $results = $openWeather->getForecastsForCityId($london);

        self::assertTrue($results->isNotEmpty());
        self::assertInstanceOf(Forecast::class, $results->first());
        self::assertTrue(today()->isSameDay($results->first()->date));
    }

    /** @test */
    public function city_search_request_returns_forecasts(): void
    {
        $openWeather = new OpenWeather();

        $london = 'London';
        $results = $openWeather->getForecastsForCityName($london);

        self::assertTrue($results->isNotEmpty());
        self::assertInstanceOf(Forecast::class, $results->first());
        self::assertTrue(today()->isSameDay($results->first()->date));
    }
}
