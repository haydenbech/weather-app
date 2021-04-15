<?php

namespace App\Console\Commands;

use App\OpenWeather;
use Illuminate\Console\Command;

class WeatherForecastsCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'weather:forecasts {cities}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Outputs a list of weather forecasts for given cities.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(OpenWeather $weather)
    {
        // @todo clean up this method
        // @todo refactor to allow adding different output formats e.g. CSV
        $days_ahead = 5;

        $cities = explode(',', $this->argument('cities'));

        $days = [today()];
        for($i = 1; $i < $days_ahead; $i++){
            $days[] = today()->addDays($i);
        }

        $city_forecasts = [];
        foreach($cities as $city){
            $city_forecasts[] = [
                $city,
                ...$weather->getForecastsForCityName($city)
                    ->take($days_ahead),
            ];
        }

        $day_headings = array_map(static function($date) {
            return $date->dayName;
        }, $days);

        $this->table([
                'City',
                ...$day_headings,
            ],
            $city_forecasts
        );

        return 1;
    }
}
