<?php

use App\Petugas;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Petugas::insert(
            [
                'user_id' => '2',
                'level' => 'petugas',
                'nama' => 'petugas',
                'telpon' => '',
                'created_at' =>now(),
            ]
        );
    }
}
