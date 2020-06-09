<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // table name
    protected $table = 'transaction';

    // primary key
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'merchandise_id', 'price', 'buy_count', 'total_price', 'complete'
    ];
}
