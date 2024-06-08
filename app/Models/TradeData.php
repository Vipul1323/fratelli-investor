<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeData extends Model{

    protected $table = "trade_data";

    protected $fillable = [
        'date_on',
        'symbol',
        'exchange',
        'open',
        'high',
        'low',
        'close',
        'last'
    ];

}
