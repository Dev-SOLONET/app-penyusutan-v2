<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Satuan;


class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuan = Satuan::select('id', 'nama','keterangan')->get();

        return view('admin.satuan.index',[
            'title'     => 'Data Satuan',
            'satuan'    => $satuan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
        ]);

        // create or update data
        Satuan::updateOrCreate(['id' => $request->id],[
            'nama'          => $request->nama,
            'keterangan'    => $request->keterangan
        ]);

        return redirect()->route('admin.satuan.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $satuan = Satuan::select('id', 'nama','keterangan')->where('id', $id)->first();

        return response()->json($satuan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // validate data
        $barang = Barang::where('id_satuan', $id)->first();

        if($barang){
            return redirect()->route('admin.satuan.index')->with('error', 'Data tidak bisa dihapus karena masih digunakan di data barang');
        }

        // delete data
        Satuan::where('id', $id)->delete();

        return redirect()->route('admin.satuan.index')->with('success', 'Data berhasil dihapus');
    }
}
