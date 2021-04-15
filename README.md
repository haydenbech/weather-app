# Weather App
_By Hayden Bech_

## Summary
This app can find a 5-day forecast for a given Australian city. It can also output a 5-day forecast for a list of cities on the command line.

## Installation
- Clone the repo.
- Run `composer install`.
- Open the home page to test the app. 
- Type `php artisan weather:forecasts {cities}` to test the command.

## Considerations

### Things I was able to achieve
- Some basic tests for the primary weather service class.
- Load API key from Laravel's services config.
- Wrote a `Forecast` class and returned a `Collection` of them. _(Though the Forecast class is based of OpenWeather's data format, one could create a wrapper for a different API and add an adaptor to output a Forecast, so our app always receives the same Forecast data.)_ 
- Gracefully handle weather server connection error.


### Things I would like to have achieved
- Tests for all classes.
- Tests for unhappy paths.
- The ability to swap the OpenWeather API for another API without changing the controller code (strategy pattern + dependency injection)
- A `City` class not tied specifically to OpenWeather (similar to the Forecast class).
- Temperature unit conversion (especially to Celsius).
- Use strategy pattern in the console command to allow other output types.
- Generally tidy up the console command code, with a focus on legibility.
- Some basic styles with Tailwind.
- Split the page into React/Vue components.
- Install a searchable dropdown component. 

## Problems I encountered
### Wrapper Class
Normally when interacting with an API I would install a wrapper package to save me writing this lower-level API code, but I wasn't happy with the options available. Though I have a sneaking suspicion you knew that would happen :)

Laravel Weather (https://github.com/gnahotelsolutions/laravel-weather) only offers current weather, but in retrospect I could have saved some time by forking it. I'm seriously considering taking some time after this challenge to write my own OpenWeather wrapper package and release it open source.

### NPM Failure
I focused only on the PHP code until I had a very basic layout, but when I wanted to focus on Tailwind and some basic styles, I encountered a serious conflict between Laravel Homestead and Windows which prevented me from running `npm install`. 

Normally, I would persist with an issue this serious until I fixed it, but due to the time constraints I went back and spent more time cleaning up the PHP code. I was hoping to revisit this problem to find a quick fix so I could have some VERY basic styles and a searchable dropdown, but this didn't happen within the time allotted.  

### Life
I had a lot of interruptions this week, so I split the development time over several days, but I still feel I could have performed better any other week. It is what it is. 

Thank you for taking the time to review this project, and I would greatly appreciate your feedback.

