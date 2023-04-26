<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png'
        ]);

        $file = $request->file('file');
        $file->move(public_path($dir = 'upload/images'), $fileName = Str::uuid().".".$file->extension());

        return response()->json([
            'file' => asset($dir . '/' . $fileName)
        ]);
    }
}
