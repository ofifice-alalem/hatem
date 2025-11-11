<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    protected $fillable = ['status_name'];

    public function workInfos()
    {
        return $this->hasMany(WorkInfo::class);
    }
}