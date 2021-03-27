<?php

use App\Pengaduan;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaduan::insert(
            [
                [
                    'aduan' => 'Terjadi kebakaran di rumah saya',
                    'gambar' => '["1616838419_logo.png"]',
                    'pengadu_id' => '3',
                    'tanggapan' => 'Pengaduan telah dilaporkan ke pihak berwajib',
                    'penanggap_id' => '1',
                    'status' => 'selesai',
                    'jenis' => 'pengaduan',
                    'created_at' =>now(),
                ],
                [
                    'aduan' => 'Ada ular di rumah saya',
                    'gambar' => '["1616838419_logo.png"]',
                    'pengadu_id' => '3',
                    'tanggapan' => null,
                    'penanggap_id' => null,
                    'status' => 'terkirim',
                    'jenis' => 'pengaduan',
                    'created_at' =>now(),
                ],
                [
                    'aduan' => 'Perbaikan jalan sebaiknya segera dilaksanakan',
                    'gambar' => '["1616838419_logo.png"]',
                    'pengadu_id' => '3',
                    'tanggapan' => 'Perbaikan akan mulai dilaksanakan bulan depan',
                    'penanggap_id' => '1',
                    'status' => 'diterima',
                    'jenis' => 'aspirasi',
                    'created_at' =>now(),
                ],
                [
                    'aduan' => 'Alasan saya melaksanakan dikediaman sendiri karena banyaknya pertimbangan terkait wabah covid-19, karena itu saya lebih memilih melaksanakan di kediaman sendiri dengan menghadirkan warga Sinjai Tengah dan Sinjai Barat dengan tetap menerapkan protokol kesehatan',
                    'gambar' => '["1616838419_logo.png"]',
                    'pengadu_id' => '3',
                    'tanggapan' => null,
                    'penanggap_id' => null,
                    'status' => 'terkirim',
                    'jenis' => 'aspirasi',
                    'created_at' =>now(),
                ]
            ],
        );
    }
}
