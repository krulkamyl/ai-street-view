<?php

namespace App\Strategies;

use App\Services\ImgAIService;
use App\Services\StreetViewService;
use App\Services\VisualCrossingService;
use App\Transformers\CurrentWeatherTransform;
use Illuminate\Http\Request;

class GenerateStreetImageStrategy
{
    public StreetViewService $streetViewService;

    public VisualCrossingService $visualCrossingService;
    public ImgAIService $imgAIService;

    public function __construct()
    {
        $this->streetViewService = new StreetViewService(config('services.google_maps.api_key'));
        $this->visualCrossingService = new VisualCrossingService(config('services.visual_crossing.api_key'));
        $this->imgAIService = new ImgAIService(config('services.getimg.api_key'));
    }

    /**
     * @throws \Exception
     */
    public static function makeImage(Request $request): string|null
    {
        $self = new self();

        $currentWeather = $self->visualCrossingService->getCurrentWeather($request->input('latitude'), $request->input('longitude'));
        $prompt = CurrentWeatherTransform::generate($currentWeather);

        $image = $self->streetViewService->fetchImage(
            $request->input('longitude'),
            $request->input('latitude'),
            $request->input('fov'),
            $request->input('heading'),
            $request->input('pitch'),
            $request->input('radius'),
        );

        if ($request->has('test')) {
            return "uploads/".$image;
        }

        if ($image) {
            $airesponse = $self->imgAIService->makeImage(
                $prompt,
                "canon 930d, realistic, photography",
                public_path("uploads/{$image}")
            );
            return "output_ai/".$airesponse;
        }
        return null;
    }
}
