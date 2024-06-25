<?php

namespace App\Domain\Statistics\Application\Index;

use App\Infrastructure\Controllers\Controller;

final class StatisticsIndexAction extends Controller
{
    public function __construct(
        private readonly StatisticsIndexResponder $statisticsResponder
    ) {}

    public function __invoke(): \Illuminate\View\View
    {
        $statisticsRespondIndex = $this->statisticsResponder->handle();
        
        return $statisticsRespondIndex;
    }
}
