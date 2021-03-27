<?php

use App\Kegiatan;
use Illuminate\Database\Seeder;

class kegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kegiatan::insert(
            [
                'user_id' => '1',
                'judul' => 'Vaksinasi',
                'kegiatan' => 'Akan diadakan vaksinasi untuk seluruh warga',
                'gambar' => '["1616838419_logo.png"]',
                'created_at' =>now(),
            ]
        );
    }
}
