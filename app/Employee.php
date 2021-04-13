<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = ['nik', 'nama_pegawai', 'jabatan_id', 'jenis_kelamin', 'tanggal_masuk', 'status_karyawan', 'photo'];

    public function jabatan()
    {
        return $this->hasOne(Sallary::class);
    }
}




