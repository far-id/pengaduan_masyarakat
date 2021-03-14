<?php

use App\Petugas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('level',array('admin', 'petugas'))->default('petugas');
            $table->string('nama');
            $table->char('telpon', 13);
            $table->timestamps();
            //FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Petugas::insert(
            [
                'user_id' => '1',
                'level' => 'admin',
                'nama' => 'admin',
                'telpon' => '',
                'created_at' =>now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petugas');
    }
}
