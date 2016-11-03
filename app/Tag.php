<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    //

    public function scopeGetFromName($query, $name)
    {
        return $query->where('name', '=', $name)->first();
    }
}
