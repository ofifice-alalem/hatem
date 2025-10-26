<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'system_no';
    protected $fillable = ['file_no', 'national_no', 'name', 'type_id', 'rank_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function militaryInfo()
    {
        return $this->hasOne(MilitaryInfo::class, 'national_no', 'national_no');
    }
}
