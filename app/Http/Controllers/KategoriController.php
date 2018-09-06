<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;

class KategoriController extends Controller
{
    public function index(){
    	$kategori = Kategori::orderBy('nama_kategori')->paginate(10);
    	return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request){
    	
    	try{
  
    		$kategori = kategori::firstOrCreate(
    			['nama_kategori' => $request->nama],
    			['deskripsi' => $request->deskripsi]
    		);

    		return redirect()->back()->with(['success' => 'Kategori ' . $kategori->nama_kategori . ' Ditambahkan']);
    		
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Terjadi Kesalahan Menambakan Kategori :: ' . $e->getMessage()]);
    	}
    }

    public function destroy($id){
    	$kategori = Kategori::findOrFail($id);
    	$kategori->delete();

    	return redirect()->back()->with(['success' => 'Kategori ' . $kategori->nama_kategori . ' Dihapus!']);
    }

    public function edit($id){
    	$kategori = Kategori::findOrFail($id);
    	return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id){
    	
    	try{
    		$kategori = Kategori::findOrFail($id);
    		$kategori->update([
    			'nama_kategori' => $request->nama,
    			'deskripsi' => $request->deskripsi
    		]);

    		return redirect(route('kategori.index'))->with(['success' => 'Kategori ' . $kategori->nama_kategori . ' Diperbaharui!']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['error' => 'Terjadi Kesalahan Update Kategori :: ' . $e->getMessage()]);
    	}

    }

}
