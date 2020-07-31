<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderline extends Model
{
    protected $fillable = [
        'orderid', 'foodid',
    ];
    public function Order()
    {
        return $this->belongsTo('order');
    }
}
