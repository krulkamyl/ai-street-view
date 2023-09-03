<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class StreetViewService
{
    public function __construct(private readonly string $accessToken)
    {
    }

    /**
     * @throws Exception
     */
    public function fetchImage(mixed $latitude, mixed $longitude, mixed $fov, mixed $heading, mixed $pitch, mixed $radius): string|null
    {
        $width = config('services.google_maps.output_width');
        $height = config('services.google_maps.output_height');

        $hash = md5($latitude.$longitude.$fov.$heading.$pitch.$radius.$width.$height);
        $fileName = $hash.'.jpg';

        if (!Storage::disk('public_uploads')->exists($fileName)) {
            $url = "https://maps.googleapis.com/maps/api/streetview?size={$width}x{$height}&location={$longitude},{$latitude}&key={$this->accessToken}&fov={$fov}&pitch={$pitch}&heading={$heading}&radius={$radius}";

            $response = Http::get($url);
            if ($response->status() == Response::HTTP_OK) {
                $imageData = $response->body();
                Storage::disk('public_uploads')->put($fileName, $imageData);
            } else {
                throw new Exception($response->body());
            }
        }

        return $fileName;
    }
}
