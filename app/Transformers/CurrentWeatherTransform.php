<?php

namespace App\Transformers;

class CurrentWeatherTransform
{
    public static function generate(array $data): string
    {
        $current = $data['currentConditions'];

        $datetime = $current['datetime'];
        $temperature = $current['temp'];

        $month = now()->format('F');

        $precib = (is_null($current['precip'])) ? 0 : $current['precip'];
        $snow = (is_null($current['snow'])) ? 0 : $current['snow'];

        $rain = match(true) {
            $precib >= 75 => ' with Rain (heavy rain)',
            $precib >= 40 => ' with Rain (medium rain)',
            $precib >= 5 => ' with Rain (light rain)',
            default => ''
        };

        $snow = match(true) {
            $snow >= 75 => ' with Snow (heavy snow)',
            $snow >= 40 => ' with Snow (medium snow)',
            $snow >= 5 => ' with Snow (light snow)',
            default => ''
        };

        return "A picture at {$datetime} with {$temperature} degreed Celsius, weather {$current['conditions']}{$rain}{$snow} in {$month}";
    }
}
