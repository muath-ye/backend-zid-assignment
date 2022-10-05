<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
