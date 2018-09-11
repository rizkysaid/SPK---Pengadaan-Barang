<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{

	protected $guarded = [];

    protected $table = 'barang';
 	
 	protected $fillable = [
 		'kode_barang', 
 		'nama_barang', 
 		'id_kategori', 
 		'id_satuan', 
 		'harga', 
 		'biaya_simpan', 
 		'biaya_pesan', 
 		'stok'
 	];

    public function kategori(){
    	return $this->belongsTo(kategori::class);
    }

    public function satuan(){
    	return $this->belongsTo(satuan::class);
    }
}
