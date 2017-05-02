<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaktuperkuliahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktuperkuliahan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hari');
            $table->time('mulai');
            $table->time('selesai');
            $table->string('kode_kelas');
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
        Schema::dropIfExists('waktuperkuliahan');
    }
}
