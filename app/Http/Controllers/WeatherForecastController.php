<?php

namespace App\Http\Controllers;

use App\OpenWeather;
use Illuminate\Http\Request;

class WeatherForecastController extends Controller
{
    public function index(Request $request, OpenWeather $weather) {
        return view('forecasts.index', [
            'cities' => $weather->getCities()
                ->filter(static function($item){
                    return $item->country === 'AU';
                })
                ->sortBy('name'),
            'forecasts' => $request->has('city') ?
                $weather->getForecastsForCityId($request->get('city')) :
                collect([]),
            'city_id' => $request->get('city')
        ]);
    }
}
