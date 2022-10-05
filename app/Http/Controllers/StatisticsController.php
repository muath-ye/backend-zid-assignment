<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function itemsCount(): JsonResponse
    {
        return new JsonResponse(['item' => Item::get()->count()]);
    }
}
