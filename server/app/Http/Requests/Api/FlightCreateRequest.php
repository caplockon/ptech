<?php

namespace App\Http\Requests\Api;

class FlightCreateRequest extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
