<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketDays extends Model
{

    protected $table = "market_days";

    protected $fillable = ['description', 'market_open_date', 'market_close_date'];
}
