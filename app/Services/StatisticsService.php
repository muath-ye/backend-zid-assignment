<?php

namespace App\Services;

use App\Models\Item;

class StatisticsService
{
    protected Item $item;

    protected int $items_count;

    protected float $average_price;

    protected string $website_highest_total_price;

    protected float $last_month_total_price;

    public function __construct()
    {
        $this->item = new Item();
        $this->items_count = $this->item->count();
        $this->average_price = $this->item->avg('price');
        $this->website_highest_total_price = $this->item->ofTotalPerWebsite()->first()->website;
        $this->last_month_total_price = $this->item->ofLastMonth()->sum('price');
    }

    public function handle(): array
    {
        return [
            'items-count' => $this->items_count,
            'average-price' => $this->average_price,
            'website-highest-total-price' => $this->website_highest_total_price,
            'last-month-total-price' => $this->last_month_total_price,
        ];
    }

    public function itemsCount(): int
    {
        return $this->items_count;
    }

    public function averagePrice(): float
    {
        return $this->average_price;
    }

    public function websiteHighestTotalPrice(): string
    {
        return $this->website_highest_total_price;
    }

    public function lastMonthTotalPrice(): float
    {
        return $this->last_month_total_price;
    }
}
