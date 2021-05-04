<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $attribute)
 */
class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'details'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
