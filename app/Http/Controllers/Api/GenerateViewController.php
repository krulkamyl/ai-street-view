<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\GenerateStreetImageStrategy;
use App\Validators\GenerateImageValidator;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GenerateViewController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(Request $request): BinaryFileResponse|JsonResponse
    {
        GenerateImageValidator::validate($request->all());

        $image = GenerateStreetImageStrategy::makeImage($request);

        if ($image) {
            return response()->file(public_path($image));
        } else {
            throw new Exception("Cant fetch photo");
        }
    }
}
