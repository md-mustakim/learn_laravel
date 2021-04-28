<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attribute)
 * @property mixed file
 */
class Employee extends Model
{
    protected $fillable = [
      'name',
      'file'
    ];
}
