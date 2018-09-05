<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangController extends Controller
{
    public function index(){
    	$barang = Barang::orderBy('created_at', 'ASC')->paginate(10);
    	return view('barang.index', compact('barang'));
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'kode' => 'required|string',
    		'nama' => 'required|string',
    		'jenis' => 'required|string',
    		'stok' => 'required|integer'
    	]);

    	try{
    		$barang = Barang::Create([
    			'kode_barang' => $request->kode,
    			'nama_barang' => $request->nama,
    			'jenis_barang' => $request->jenis,
    			'stok_barang' => $request->stok
    		]);

    		return redirect()->back()->with(['success' => $request->nama . ' telah ditambahkan !']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Gagal Menambahkan ' . $request->nama . ' ! - ' . $e->getMessage()]);
    		//dd($e);
    	}
    }

    public function destroy($id){
    	$barang = Barang::findOrFail($id);
    	$barang->delete();
    	return redirect()->back()->with(['success' => 'Barang '. $barang->nama_barang . ' telah dihapus !']);
    }

    public function edit($id){
    	$barang = Barang::findOrFail($id);
    	return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id){
    	try{
	    	$barang = Barang::findOrFail($id);
	    	$barang->update([
	    		'nama_barang' => $request->nama,
	    		'jenis_barang' => $request->jenis,
	    		'stok_barang' => $request->stok
	    	]);

	    	return redirect(route('barang.index'))->with(['success' => 'Barang ' . $barang->nama_barang . ' telah diperbaharui !']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Gagal memperbaharui data ' . $barang->nama_barang . ' !']);
    	}
    }
}
