<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengadaan', function(Blueprint $table){
            $table->integer('id_barang')->unsigned()->change();
            $table->foreign('id_barang')->references('id')->on('barang')
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
        Schema::table('pengadaan', function(Blueprint $table){
            $table->dropForeign('pengadaan_id_barang_foreign');
        });
        Schema::table('pengadaan', function(Blueprint $table){
            $table->dropIndex('pengadaan_id_barang_foreign');
        });
        Schema::table('pengadaan', function(Blueprint $table){
            $table->integer('id_barang')->change();
        });
    }
}
