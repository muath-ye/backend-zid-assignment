<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\StatisticsService;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(StatisticsService $statisticsService): JsonResponse
    {
        return new JsonResponse($statisticsService->handle());
    }
}
