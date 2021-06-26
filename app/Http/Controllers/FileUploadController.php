<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{

    public function uppy(Request $request)
    {
        $filePath = $request->file->store('uppy-images', 's3');
        return response()->json([
            'filePath' => $filePath,
        ]);
    }
}
