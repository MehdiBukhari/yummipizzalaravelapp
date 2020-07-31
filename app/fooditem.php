<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fooditem extends Model
{
    protected $fillable = [
        'proname', 'descrpation', 'imagepath','price','menuitemnid',
    ];
    public function MenuItem()
    {
        return $this->belongsTo('MenuItem');
    }
}
