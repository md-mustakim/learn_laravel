<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @method static findOrFail(mixed $id)
 * @method static create(array $attributes)
 * @property mixed name
 * @property mixed details
 * @property mixed category
 * @property mixed id
 */
class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
        'category_id',
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
