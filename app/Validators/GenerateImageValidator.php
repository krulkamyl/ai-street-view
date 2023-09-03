<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GenerateImageValidator
{
    /**
     * @throws ValidationException
     */
    public static function validate(array $data)
    {
        $rules = [
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'fov' => ['integer', 'min:0', 'max:1000', 'required'],
            'pitch' => ['integer', 'min:0', 'max:100', 'required'],
            'heading' => ['required', 'integer'],
            'radius' => ['required', 'integer'],
        ];

        return Validator::make($data, $rules)->validate();
    }
}
