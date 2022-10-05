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
    
    public function averagePrice(): JsonResponse
    {
        return new JsonResponse(['item' => Item::avg('price')]);
    }
    
    public function highestTotalPrice($website): JsonResponse
    {
        return new JsonResponse(['item' => Item::ofUrl($website)->max('price')]);
    }
}
