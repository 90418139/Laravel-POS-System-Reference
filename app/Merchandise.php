<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static OrderBy(string $string, string $string1)
 */
class Merchandise extends Model
{
    // table name
    protected $table = 'merchandise';

    // primary key
    protected $primaryKey = 'id';

    protected $fillable = [
      'status', 'class','name', 'introduction', 'photo', 'price',
    ];
}
