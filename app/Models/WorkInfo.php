<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkInfo extends Model
{
    protected $table = 'work_info';
    
    protected $fillable = [
        'national_id', 'work_authority', 'work_location', 'office', 'assigned_task',
        'employment_status_id', 'employment_status_detail', 'employment_notes',
        'reviewed', 'leadership', 'financial_number', 'direct_date', 'wife_nationality',
        'transfer_decision_number', 'transfer_date', 'transfer_authority',
        'academic_degree', 'academic_degree_date'
    ];

    protected $casts = [
        'reviewed' => 'boolean',
        'leadership' => 'boolean',
        'direct_date' => 'date',
        'transfer_date' => 'date',
        'academic_degree_date' => 'date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'national_id', 'national_id');
    }

    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}