<?php

namespace App\Http\Requests\Api;

class FlightUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|min:1',
            'description' => 'string|min:1',
        ];
    }
}
