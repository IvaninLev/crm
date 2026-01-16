<?php

namespace App\Models\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload(Request $request, string $path): ?string
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->hashName();
            Storage::putFile($path, $file);
            return $path . '/' . $fileName;
        }
        return null;
    }
}
