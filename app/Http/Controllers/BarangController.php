<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\kategori;
use App\satuan;
use DB;

class BarangController extends Controller
{
    public function index(){

//        $barang = barang::with('kategori')->orderBy('nama_barang', 'ASC')->paginate(10);
  
        $barang = DB::table('barang')
                    ->join('kategori', 'id_kategori', '=', 'kategori.id')
                    ->join('satuan', 'id_satuan', '=', 'satuan.id')
                    ->select('barang.*', 'kategori.nama_kategori', 'satuan.nama_satuan')
                    ->get();

        $kategori = kategori::orderBy('nama_kategori', 'ASC')->get();
        $satuan = satuan::orderBy('nama_satuan', 'ASC')->get();

        return view('barang.index', compact('barang', 'kategori', 'satuan'));
//        dd($barang);

    }

    public function store(Request $request){

    /*    	$this->validate($request, [
        		'kode_barang' => 'required|string|max:10|unique:barang',
        		'nama_barang' => 'required|string|max:100',
        		'id_kategori' => 'required|integer|exists:kategori,id',
                'id_satuan' => 'required|integer|exists:satuan,id',
                'harga' => 'required|integer',
                'biaya_simpan' => 'required|integer',
        		'stok' => 'required|integer'
        	]);
*/
    	try{
    		$barang = Barang::firstOrCreate([
    			     'kode_barang' => $request->kode
                 ], [
        			'nama_barang' => $request->nama,
        			'id_kategori' => $request->kategori,
                    'id_satuan' => $request->satuan,
                    'harga' => $request->harga,
                    'biaya_simpan' => $request->biaya,
        			'stok' => $request->stok
    		]);

    		return redirect()->back()->with(['success' => $request->nama . ' telah ditambahkan !']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Gagal Menambahkan Barang (' . $request->nama . ')  => ' . $e->getMessage()]);
    	}
    }

    public function destroy($id){
    	$barang = Barang::findOrFail($id);
    	$barang->delete();
    	return redirect()->back()->with(['success' => 'Barang '. $barang->nama_barang . ' telah dihapus !']);
    }

    public function edit($id){
        
    	$ngambil_id = DB::table('barang')
                    ->join('kategori', 'id_kategori', '=', 'kategori.id')
                    ->join('satuan', 'id_satuan', '=', 'satuan.id')
                    ->select('barang.*', 'kategori.nama_kategori', 'kategori.deskripsi', 'satuan.nama_satuan')
                    ->where('barang.id', $id)
                    ->get();

        $barang = barang::with('kategori')->findOrFail($id)->get();

        $kategori = kategori::orderBy('nama_kategori', 'ASC')->get();
        $satuan = satuan::orderBy('nama_satuan', 'ASC')->get();

    	return view('barang.edit', compact('barang', 'kategori', 'satuan', 'ngambil_id'));
        //dd($ngambil_id);
    }

    public function update(Request $request, $id){
    	try{
	    	$barang = Barang::findOrFail($id);
	    	$barang->update([
	    		'nama_barang' => $request->nama,
	    		'id_kategori' => $request->kategori,
                'id_satuan' => $request->satuan,
                'harga' => $request->harga,
                'biaya_simpan' => $request->biaya_simpan,
	    		'stok' => $request->stok
	    	]);

	    	return redirect(route('barang.index'))->with(['success' => 'Barang ' . $barang->nama_barang . ' telah diperbaharui !']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Gagal memperbaharui data ' . $barang->nama_barang . ' ! <br>
                ' . $e->getMessage() ]);
    	}
    }
}
