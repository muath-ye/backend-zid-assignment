<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Scope a query to only include last month
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTotalPricePerWebsite($query)
    {
        $parsed_url = "SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(url, '/', 3), '://', -1), '/', 1), '?', 1)";

        return $query->selectRaw("$parsed_url AS website")
        ->groupByRaw("$parsed_url")
        ->orderByRaw('SUM(price) DESC');
    }

    /**
     * Scope a query to only include last month
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLastMonth($query)
    {
        return $query->whereMonth('created_at', '=', Carbon::now()->month);
    }
}
