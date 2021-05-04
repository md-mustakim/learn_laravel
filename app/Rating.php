<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes)
 */
class Rating extends Model
{
    protected $fillable = [
        'score',
        'title',
        'details',
        'product_id',
        'user_id'
    ];
}
