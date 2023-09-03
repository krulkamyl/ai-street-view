<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class VisualCrossingService
{
    public function __construct(private string $accessToken)
    {
    }

    public function getCurrentWeather(mixed $latitude, mixed $longitude): array|null
    {
        $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/{$latitude},{$longitude}?unitGroup=metric&include=current&key={$this->accessToken}&contentType=json";
        return Http::get($url)->json();
    }
}
