<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang', function(Blueprint $table){
            $table->integer('id_kategori')->unsigned()->change();
            $table->foreign('id_kategori')->references('id')->on('kategori')
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
            $table->dropForeign('barang_id_kategori_foreign');
        });
        Schema::table('barang', function(Blueprint $table){
            $table->dropIndex('barang_id_kategori_foreign');
        });
        Schema::table('barang', function(Blueprint $table){
            $table->integer('id_kategori')->change();
        });
    }
}
