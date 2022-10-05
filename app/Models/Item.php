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
     * Scope a query to only include website url
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $url
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfUrl($query, $url)
    {
        return $query->where('url', 'like', 'https://'.$url.'%');
    }

    /**
     * Scope a query to only include last month
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLastMonth($query)
    {
        return $query->whereMonth('created_at', '=', Carbon::now()->subMonth()->month);
    }
}
