<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    
    protected $fillable = [
        'file_type', 'file_number', 'rank_id', 'name', 'birth_date', 'birth_place',
        'gender', 'mother_name', 'mother_nationality', 'blood_type', 'national_id',
        'personal_card_number', 'passport_number'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    protected static function booted()
    {
        static::updated(function ($person) {
            if ($person->isDirty('rank_id') && $person->militaryInfo) {
                $person->militaryInfo->updateQuietly(['military_rank_id' => $person->rank_id]);
            }
        });
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function militaryInfo()
    {
        return $this->hasOne(MilitaryInfo::class, 'national_id', 'national_id');
    }

    public function workInfo()
    {
        return $this->hasOne(WorkInfo::class, 'national_id', 'national_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'national_id', 'national_id');
    }
}
