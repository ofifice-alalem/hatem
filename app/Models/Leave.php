<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'national_id', 'leave_type_id', 'start_date', 'end_date', 'total_days'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'national_id', 'national_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}