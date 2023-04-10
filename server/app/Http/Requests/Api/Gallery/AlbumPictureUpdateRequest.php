<?php

namespace App\Http\Requests\Api\Gallery;

use App\Http\Requests\Api\Request;

class AlbumPictureUpdateRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'image' => 'array'
        ];
    }
}

