<?php

use App\Masyarakat;
use Illuminate\Database\Seeder;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Masyarakat::insert(
            [
                'user_id' => '3',
                'kk' => '0000000000000000',
                'nik' => '0000000000000000',
                'nama' => 'masyarakat',
                'alamat' => 'Gunung Putri, Bogor',
                'lahir' => '2021-2-24',
                'telpon' => '080808080808',
                'created_at' =>now(),
            ]
        );
    }
}
