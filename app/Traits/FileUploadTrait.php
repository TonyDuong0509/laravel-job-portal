<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait
{
    public function uploadFile(Request $request, string $inputName, ?string $oldPath = null, $path = '/uploads'): string
    {
        if ($request->hasFile($inputName)) {
            $file = $request->{$inputName}; // $request->logo
            $ext = $file->getClientOriginalExtension(); // .jpg
            $fileName = 'media_' . uniqid() . '.' . $ext;

            $file->move(public_path($path), $fileName);

            return $path . '/' . $fileName;
        }
        return '';
    }
}
