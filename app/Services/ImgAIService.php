<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Image;

class ImgAIService
{
    public function __construct(private readonly string $accessToken)
    {
    }

    /**
     * @throws Exception
     */
    public function makeImage($prompt, $negative_prompt, $image): string
    {
        $url = 'https://api.getimg.ai/v1/stable-diffusion/image-to-image';

        $image = base64_encode(file_get_contents($image));

        $data = [
            'model' => config('services.getimg.model'),
            'prompt' => $prompt,
            'negative_prompt' => $negative_prompt,
            'image' => $image,
            'strength' => config('services.getimg.strength'),
            'steps' => config('services.getimg.steps'),
            'guidance' => config('services.getimg.guidance'),
            'seed' => config('services.getimg.seed'),
            'scheduler' => config('services.getimg.scheduler'),
            'output_format' => config('services.getimg.output_format'),
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->post($url, $data);
        if ($response->status() == 200) {
            $filename = Str::random(30).'.jpg';
            Image::make($response['image'])->save(public_path('output_ai').'/'.$filename);
            return $filename;
        }
        else {
            throw new Exception($response->body());
        }
    }
}
