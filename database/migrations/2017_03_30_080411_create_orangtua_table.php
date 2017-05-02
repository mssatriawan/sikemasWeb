<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangtuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orangtua', function (Blueprint $table) {
            $table->increments('id_wali');
            $table->string('nama');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_telpon');
            $table->string('nrp');
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
        Schema::dropIfExists('orangtua');
    }
}
