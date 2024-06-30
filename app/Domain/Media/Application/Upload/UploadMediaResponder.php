<?php

namespace App\Domain\Media\Application\Upload;

use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;

final class UploadMediaResponder
{
    public function handle(array $data): JsonResponse
    {
        return response()->json($data);
    }
}
