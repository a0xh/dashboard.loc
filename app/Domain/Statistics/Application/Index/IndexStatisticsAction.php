<?php

namespace App\Domain\Statistics\Application\Index;

use App\Infrastructure\Controllers\Controller;
use Spatie\RouteAttributes\Attributes\Get;

final class IndexStatisticsAction extends Controller
{
    public function __construct(
        private readonly IndexStatisticsResponder $statisticsResponder
    ) {}

    #[Get('/admin', name: "admin.statistics.index")]
    public function __invoke(): \Illuminate\View\View
    {
        return $this->statisticsResponder->handle();
    }
}
