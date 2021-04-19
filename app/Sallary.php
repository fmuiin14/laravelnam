<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sallary extends Model
{
    protected $table = 'salaries';

    protected $fillable = ['nama_jabatan', 'gaji_pokok', 'tj_transport', 'uang_makan'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
