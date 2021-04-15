<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div>
    <h1>Weather</h1>
    <form>
        <label for="city">Choose a city</label>
        <select id="city" name="city">
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ (int) $city_id === $city->id ? 'selected' : '' }}>{{ $city->name }}, {{ $city->country }}</option>
            @endforeach
        </select>

        <input value="Go" type="submit">
    </form>
    @if($city)
        <h2>5-day Forecast for {{ $cities->firstWhere('id', $city_id)->name }}</h2>
        @if( $forecasts->isNotEmpty() )
        <ul>
            @foreach($forecasts as $forecast)
                <li>
                    {{ $forecast }}
                </li>
            @endforeach
        </ul>
        @else
            Could not load forecasts for this city.
        @endif
    @endif
</div>
</body>
</html>
