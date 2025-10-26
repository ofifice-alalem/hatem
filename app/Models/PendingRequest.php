<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRequest extends Model
{
    protected $fillable = [
        'person_id', 'old_type_id', 'new_type_id', 'old_rank_id', 'new_rank_id',
        'old_military_no', 'new_military_no', 'status'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'system_no');
    }

    public function oldType()
    {
        return $this->belongsTo(Type::class, 'old_type_id');
    }

    public function newType()
    {
        return $this->belongsTo(Type::class, 'new_type_id');
    }

    public function oldRank()
    {
        return $this->belongsTo(Rank::class, 'old_rank_id');
    }

    public function newRank()
    {
        return $this->belongsTo(Rank::class, 'new_rank_id');
    }
}
