<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['rank_name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(RankCategory::class, 'category_id');
    }

    public function persons()
    {
        return $this->hasMany(Person::class);
    }

    public function militaryInfos()
    {
        return $this->hasMany(MilitaryInfo::class, 'military_rank_id');
    }
}
