<?php declare(strict_types=1);

namespace App\Domain\Page\Infrastructure;

use App\Domain\Page\Domain\Page;
use Illuminate\Pagination\LengthAwarePaginator;

interface PageRepositoryInterface
{
    public function getPage(int $count): LengthAwarePaginator;
    public function createPage(array $data): bool;
    public function updatePage(Page $page, array $data): bool;
    public function deletePage(Page $page): bool;
}
