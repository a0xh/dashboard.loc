<?php

namespace App\Domain\Statistics\Application\Index;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

final class StatisticsIndexResponder
{
    public function handle(): \Illuminate\View\View
    {
        return View::first(['statistics.index']);
    }
}
