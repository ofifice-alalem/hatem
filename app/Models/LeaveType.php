<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = ['type_name'];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}