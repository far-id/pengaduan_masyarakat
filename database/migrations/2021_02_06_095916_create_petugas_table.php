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
                'username' => 'admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'level' => 'admin',
                'created_at' =>Carbon::now()->setTimezone('Asia/Jakarta'),
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
