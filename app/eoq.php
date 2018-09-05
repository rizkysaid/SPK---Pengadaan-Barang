<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang;

class eoq extends Model
{
    public function barang(){
    	return $this->belongsTo(barang::class);
    }
}
