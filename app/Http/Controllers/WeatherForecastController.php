<?php


namespace App\Http\Controllers;


use App\OpenWeather;

class WeatherForecastController extends Controller
{
    public function index(OpenWeather $weather) {
        return view('forecasts.index', [
            'forecasts' => $weather->getForecastsForCity(7839501),
        ]);
    }
}
