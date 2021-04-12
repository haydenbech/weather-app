<?php

namespace Tests\Unit;

use App\Forecast;
use App\OpenWeather;
use Tests\TestCase;

class OpenWeatherTest extends TestCase
{
    /** @test */
    public function request_returns_forecasts(): void
    {
        $openWeather = new OpenWeather(config('services.openweather.key'));

        $london = 2643743;
        $results = $openWeather->getForecasts($london);

        self::assertTrue($results->isNotEmpty());
        self::assertInstanceOf(Forecast::class, $results->first());
        self::assertTrue(today()->isSameDay($results->first()->date));
    }
}