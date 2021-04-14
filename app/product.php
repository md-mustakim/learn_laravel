<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @method static findOrFail(mixed $id)
 * @property mixed name
 * @property mixed details
 * @property mixed category
 * @property mixed id
 */
class product extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
        'category_id',
        'image'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
