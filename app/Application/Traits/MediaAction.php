<?php

namespace App\Application\Traits;

use Illuminate\Support\Facades\{File, Storage};
use Illuminate\Http\UploadedFile;
trait MediaAction
{
    public function createMedia(?UploadedFile $request): ?string
    {
        if (request()->hasFile('media')) {
            return $request?->store(date('Y-m'));
        }

        return $request;
    }

    public function updateMedia(?string $media, ?UploadedFile $request): ?string
    {
        if (request()->hasFile('media')) {
            if (isset($media)) {
                $checkFile = File::exists(Storage::path($media));

                if ($checkFile) {
                    Storage::disk('public')->delete($media);
                }
            }

            return $request?->store(date('Y-m'));
        }

        return $media;
    }

    public function deleteMedia(?string $media): ?string
    {
        if (isset($media)) {
            $checkFile = File::exists(Storage::path($media));

            if ($checkFile) {
                Storage::disk('public')->delete($media);
            }
        }

        return $media;
    }
}