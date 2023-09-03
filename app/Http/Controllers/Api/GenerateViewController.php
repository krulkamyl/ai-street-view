<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\GenerateStreetImageStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GenerateViewController extends Controller
{
    public function __invoke(Request $request): BinaryFileResponse| JsonResponse
    {
        $image = GenerateStreetImageStrategy::makeImage($request);


        if ($image) {
            return response()->file(public_path("output_ai/$image"));
        } else {
            return response()->json(['error' => 'Can\t fetch photo. Soory :( ']);
        }
    }
}
