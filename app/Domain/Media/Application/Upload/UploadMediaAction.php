<?php

namespace App\Domain\Media\Application\Upload;

use App\Infrastructure\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\Post;
use Illuminate\Http\{UploadedFile, JsonResponse};
use Illuminate\Support\Facades\Storage;

final class UploadMediaAction extends Controller
{
    public function __construct(
        private readonly UploadMediaResponder $mediaResponder
    ) {}

    #[Post('/admin/media/upload', name: "admin.media.upload")]
    public function __invoke(): JsonResponse
    {
        if (request()->hasFile('upload'))
        {
            $media = request()->file('upload')->store(date('Y-m'));

            return $this->mediaResponder->handle([
                'fileName' => $media,
                'uploaded'=> 1,
                'url' => Storage::url($media)
            ]);
        }
    }
}