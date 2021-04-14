<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
