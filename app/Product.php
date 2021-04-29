<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @method static findOrFail(mixed $id)
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
}
