<?php

namespace App\Domain\Statistics\Application\Index;

use Illuminate\Support\Facades\View;

final class IndexStatisticsResponder
{
    public function handle(): \Illuminate\View\View
    {
        return View::make('admin::statistics.index');
    }
}
