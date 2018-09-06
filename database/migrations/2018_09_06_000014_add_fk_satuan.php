<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkSatuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang', function(Blueprint $table){
            $table->integer('id_satuan')->unsigned()->change();
            $table->foreign('id_satuan')->references('id')->on('satuan')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang', function(Blueprint $table){
            $table->dropForeign('barang_id_satuan_foreign');
        });
        Schema::table('barang', function(Blueprint $table){
            $table->dropIndex('barang_id_satuan_foreign');
        });
        Schema::table('barang', function(Blueprint $table){
            $table->integer('id_satuan')->change();
        });
    }
}
