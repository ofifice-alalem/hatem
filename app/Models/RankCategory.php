<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankCategory extends Model
{
    protected $fillable = ['category_name'];

    public function ranks()
    {
        return $this->hasMany(Rank::class, 'category_id');
    }
}