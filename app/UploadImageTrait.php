<?php

namespace App;

trait UploadImageTrait
{
    public function uploadImage($image, string $folder): ?string
    {
        if ($image) {
            $timestamp = now()->timestamp;
            $extension = $image->getClientOriginalExtension();
            $filename = \Str::random(10) . '_' . $timestamp . '.' . $extension;

            $url = $image->storeAs("public/$folder", $filename);

            return $url;
        }
        return null;
    }
}
