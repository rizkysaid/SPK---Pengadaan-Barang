<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class EoqsController extends Controller
{
    public function show($id){

    	$barang = Barang::findOrFail($id);
    	$eoqs = eoq::findOrFail($id);
    	return view('eoqs.index', compact('barang', 'eoqs'));
    }
}
