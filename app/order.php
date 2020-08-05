<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'userid', 'totalPrice','adress','mobileNumber',
    ];
    public function orderline()
    {
        return $this->hasMany("App\orderline", 'orderid', 'id');
    }
    public function User()
    {
        return $this->belongsTo('user');
    }
}
