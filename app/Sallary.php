<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sallary extends Model
{
    protected $table = 'salaries';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
