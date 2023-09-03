<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VisualCrossingService
{
    public function __construct(private readonly string $accessToken)
    {
    }

    /**
     * @throws Exception
     */
    public function getCurrentWeather(mixed $latitude, mixed $longitude): array|null
    {
        $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/{$latitude},{$longitude}?unitGroup=metric&include=current&key={$this->accessToken}&contentType=json";

        $response = Http::get($url);
        if ($response->status() == Response::HTTP_OK) {
            return $response->json();
        }
        throw new Exception($response->body());
    }
}
