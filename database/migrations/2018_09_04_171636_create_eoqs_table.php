<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEoqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_barang');
            $table->integer('periode');
            $table->integer('keb_per_periode');
            $table->integer('biaya_penyimpanan');
            $table->integer('lead_time');
            $table->integer('persen_safety_stock');
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
        Schema::dropIfExists('eoqs');
    }
}
