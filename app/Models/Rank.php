<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['rank_name', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}
