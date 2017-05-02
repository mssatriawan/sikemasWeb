<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerkuliahanmahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkuliahanmahasiswa', function (Blueprint $table) {
            $table->increments('id_perkuliahanmahasiswa');
            $table->integer('pertemuan');
            $table->char('status_perkuliahan',1);
            $table->char('status_dosen',1);
            $table->integer('kode_kelas');
            $table->date('tanggal');
            $table->integer('hari');
            $table->time('mulai');
            $table->time('selesai');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perkuliahanmahasiswa');
    }
}
