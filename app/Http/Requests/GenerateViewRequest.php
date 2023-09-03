<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => 'required|regex:^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$',
            'longitude' => 'required|regex:^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$',
            'fov' => 'integer|min:0|max:1000|required',
            'pitch' => 'integer|min:0|max:100|required',
        ];
    }
}
