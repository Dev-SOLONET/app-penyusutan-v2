<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // default value
        $tgl_awal   = $request->tgl_awal ?? date('Y-m-01');
        $tgl_akhir  = $request->tgl_akhir ?? date('Y-m-t');

        // get data barang
        $barang = Barang::with(['pengguna', 'satuan'])
                    ->whereBetween('tgl_beli', [$tgl_awal, $tgl_akhir])
                    ->get();

        return view('admin.barang.index', [
            'title'     => 'Barang',
            'barang'    => $barang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.create', [
            'title' => 'Tambah Barang',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
