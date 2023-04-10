<?php

namespace App\Http\Requests\Api\Gallery;

use App\Http\Requests\Api\Request;

class AlbumCreateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5',
            'description' => 'string|min:20'
        ];
    }
}
