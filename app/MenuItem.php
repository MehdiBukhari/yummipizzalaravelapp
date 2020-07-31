<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
    ];
    public function fooditem()
    {
        return $this->hasMany("App\fooditem", 'menuitemnid', 'id');
    }
}
