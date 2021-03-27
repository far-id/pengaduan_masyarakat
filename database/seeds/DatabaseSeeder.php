<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(MasyarakatSeeder::class);
        $this->call(kegiatanSeeder::class);
        $this->call(PengaduanSeeder::class);
    }
}
