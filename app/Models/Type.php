<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['type_name'];

    public function ranks()
    {
        return $this->hasMany(Rank::class);
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}
