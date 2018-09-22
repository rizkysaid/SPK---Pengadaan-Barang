<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\eoq;
use DB;

class EoqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DB::table('barang')->get();
        return view('eoq.index', compact('barang'));
    }

    public function hasilEOQ() 
    {
        $barang = DB::table('eoq')
                    ->join('barang', 'eoq.id_barang', '=', 'barang.id')
                    ->select('eoq.*', 'barang.nama_barang')
                    ->get();

        return view('eoq.hasil_eoq', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = eoq::firstOrCreate([
            'id_barang'     => $request->id_barang,
            'kebutuhan'     => $request->kebper,
            'periode'       => $request->periode,
            'pengaman'      => $request->kebpeng,
            'waktu_pesan'   => $request->waktu,
            'eoq'           => $request->eoq,
            'safety'        => $request->safety,
            'rop'           => $request->rop
        ]);

        return redirect()->back()->with(['success' => 'Data EOQ telah disimpan !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eoq = DB::table('eoq')
                    ->join('barang', 'eoq.id_barang', '=', 'barang.id')
                    ->select('eoq.*', 'barang.nama_barang')
                    ->where('eoq.id', $id)
                    ->get();

        $barang = DB::table('barang')->get();

        return view('eoq.edit_eoq', compact('eoq', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eoq = eoq::findOrFail($id);
        $eoq->update([
            'id_barang'     => $request->id_barang,
            'kebutuhan'     => $request->kebper,
            'periode'       => $request->periode,
            'pengaman'      => $request->kebpeng,
            'waktu_pesan'   => $request->waktu,
            'eoq'           => $request->eoq,
            'safety'        => $request->safety,
            'rop'           => $request->rop
        ]);

        return redirect('eoq/hasil_eoq')->with(['success' => 'Data EOQ telah diubah !']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eoq = eoq::findOrFail($id);
        $eoq->delete();
        return redirect()->back()->with(['success' => 'Data EOQ telah dihapus !']);
    }
}
