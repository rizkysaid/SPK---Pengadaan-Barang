<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableEOQ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoq', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_barang')->unique();
            $table->integer('kebutuhan');
            $table->integer('periode');
            $table->integer('pengaman');
            $table->integer('waktu_pesan');
            $table->integer('eoq');
            $table->integer('safety');
            $table->integer('rop');
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
        Schema::dropIfExists('barang');
    }
}
