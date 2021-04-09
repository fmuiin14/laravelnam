<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Employee::create([
            'nik' => '1',
            'nama_pegawai' => 'Satu Pegawai',
            'jenis_kelamin' => 'M',
            'tanggal_masuk' => \Carbon\Carbon::createFromDate(2000,01,01)->toDateTimeString(),
            'status_karyawan' => 'lepas',
            'photo' => 'default.jpg',
        ]);

        $employee = Employee::create([
            'nik' => '2',
            'nama_pegawai' => 'admin@fmuiin.com',
            'jenis_kelamin' => 'F',
            'tanggal_masuk' => \Carbon\Carbon::createFromDate(2000,01,01)->toDateTimeString(),
            'status_karyawan' => 'tetap',
            'photo' => 'default.jpg',
        ]);
    }
}
