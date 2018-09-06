<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\satuan;

class SatuanController extends Controller
{
    public function index(){
    	$satuan = satuan::orderBy('nama_satuan')->paginate(10);
    	return view('satuan.index', compact('satuan'));
    }

    public function store(Request $request){
    	try{
    		$satuan = satuan::firstOrCreate([
    			'nama_satuan' => ucfirst($request->nama)
    		]);

    		return redirect()->back()->with(['success' => 'Data Satuan ' . $satuan->nama_satuan . ' Ditambahkan']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['Error' => 'Gagal menambahkan ' . $satuan->nama_satuan . '!']);
    	}
    }

    public function destroy($id){
    	$satuan = satuan::findOrFail($id);
    	$satuan->delete();
    	return redirect()->back()->with(['success' => 'Data Satuan ' . $satuan->nama_satuan . ' Dihapus!']);
    }

    public function edit(Request $request, $id){
    	$satuan = satuan::findOrFail($id);
    	return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id){
    	try{
	    	$satuan = satuan::findOrFail($id);
	    	$satuan->update([
	    		'nama_satuan' => ucfirst($request->nama)
	    	]);
	    	return redirect(route('satuan.index'))->with(['success' => 'Data Satuan ' . $satuan->nama_satuan . ' Telah Diperbaharui!']);
    	}catch(\Exception $e){
    		return redirect()->back()->with(['Error' => 'Gagal memperbaharui ' . $satuan->nama_satuan . '!']);
    	}
    }
}
