<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->text('aduan');
            $table->string('gambar');
            $table->bigInteger('pengadu_id')->unsigned();
            $table->text('tanggapan')->nullable();
            $table->bigInteger('penanggap_id')->unsigned()->nullable();
            $table->enum('status',array('terkirim','proses', 'selesai', 'diterima', 'ditolak'))->default('terkirim');
            $table->enum('jenis',array('pengaduan', 'aspirasi'))->default('pengaduan');
            $table->timestamps();
            //FK
            $table->foreign('pengadu_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penanggap_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
}
