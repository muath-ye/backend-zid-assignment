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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['website'];

    /**
     * Get the url's website.
     *
     * @param  string  $value
     * @return string
     */
    public function getWebsiteAttribute($value)
    {
        return parse_url($this->url)['host'];
    }

    /**
     * Scope a query to only include last month
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLastMonth($query)
    {
        return $query->whereMonth('created_at', '=', Carbon::now()->month);
    }
}
