<?php

use Illuminate\Database\Seeder;
use App\Sallary;

class SalariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sallary::create([
            'nama_jabatan' => 'Pramukantor',
            'gaji_pokok' => '1500000',
            'tj_transport' => '300000',
            'uang_makan' => '200000'
        ]);

        Sallary::create([
            'nama_jabatan' => 'Finance',
            'gaji_pokok' => '2500000',
            'tj_transport' => '300000',
            'uang_makan' => '300000'
        ]);
    }
}
