<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(mixed $id)
 * @property mixed name
 * @property mixed details
 * @property mixed category
 */
class product extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
        'category'
    ];
}
