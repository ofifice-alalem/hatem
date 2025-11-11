<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRequest extends Model
{
    protected $fillable = [
        'type',
        'record_id',
        'original_data',
        'new_data',
        'status',
        'requested_by',
        'reviewed_by',
        'rejection_reason'
    ];

    protected $casts = [
        'original_data' => 'array',
        'new_data' => 'array'
    ];

    public function getRecordAttribute()
    {
        switch ($this->type) {
            case 'person':
            case 'rank_change':
                return Person::find($this->record_id);
            case 'military_info':
                return MilitaryInfo::with('person')->find($this->record_id);
            case 'work_info':
                return WorkInfo::with('person')->find($this->record_id);
            default:
                return null;
        }
    }

    public function getPersonAttribute()
    {
        switch ($this->type) {
            case 'person':
            case 'rank_change':
                return Person::find($this->record_id);
            case 'military_info':
                $militaryInfo = MilitaryInfo::find($this->record_id);
                return $militaryInfo ? Person::where('national_id', $militaryInfo->national_id)->first() : null;
            case 'work_info':
                $workInfo = WorkInfo::find($this->record_id);
                return $workInfo ? Person::where('national_id', $workInfo->national_id)->first() : null;
            default:
                return null;
        }
    }
}