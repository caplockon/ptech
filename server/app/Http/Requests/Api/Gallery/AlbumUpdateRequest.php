<?php

namespace App\Http\Requests\Api\Gallery;

use App\Http\Requests\Api\Request;

class AlbumUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|min:5',
            'description' => 'string|min:20'
        ];
    }
}
