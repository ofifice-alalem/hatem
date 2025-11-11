<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilitaryInfo extends Model
{
    protected $table = 'military_info';
    
    protected $fillable = [
        'national_id', 'military_rank_id', 'military_number', 'appointment_date',
        'appointment_authority', 'appointment_decision_number', 'last_promotion_date',
        'last_promotion_decision', 'last_promotion_year', 'seniority'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'last_promotion_date' => 'date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'national_id', 'national_id');
    }

    public function militaryRank()
    {
        return $this->belongsTo(Rank::class, 'military_rank_id');
    }
}
