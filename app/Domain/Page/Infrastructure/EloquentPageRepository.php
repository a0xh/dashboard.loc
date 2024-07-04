<?php declare(strict_types=1);

namespace App\Domain\Page\Infrastructure;

use App\Domain\Page\Domain\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentPageRepository extends DecoratorPageRepository
{
    public function __construct(protected Page $page) {}

    public function getPage(int $count): LengthAwarePaginator
    {
        return $this->page->query()->with('user')->orderByDesc('created_at')->paginate($count);
    }

    public function createPage(array $data): bool
    {
        try {
            DB::transaction(function() use($data) {
                $this->page->create($data);
            }, 3);

            return $this->page->exists();
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function updatePage(Page $page, array $data): bool
    {
        try {
            DB::transaction(function() use($page, $data) {
                $page->update($data);
            }, 3);

            return true;
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }

    public function deletePage(Page $page): bool
    {
        try {
            DB::transaction(function() use($page) {
                $page->delete();
            }, 3);

            if ($page->deleteOrFail() !== true) {
                return true;
            } else {
                return false;
            }
        }

        catch (\ExternalServiceException $exception) {
            return false;
        }
    }
}
