<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilitaryInfo extends Model
{
    protected $table = 'military_info';
    protected $fillable = ['national_no', 'military_no'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'national_no', 'national_no');
    }
}
