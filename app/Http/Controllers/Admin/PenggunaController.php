<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengguna::with([
            'account_debit',
            'account_kredit',
            'n_account_debit',
            'n_account_kredit'
        ])->select('id','nama','lr_id_account_debit','lr_id_account_kredit','n_id_account_debit','n_id_account_kredit')
        ->get();

        $account = Account::select('id_account','nama_account')
        ->orderBy('nama_account')
        ->get();

        return view('admin.pengguna.index',[
            'title'     => 'Data Pengguna',
            'data'      => $data,
            'account'   => $account
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
        // validasi
        $request->validate([
            'nama'        => 'required',
            'debit'       => 'required',
            'kredit'      => 'required',
            'n_debit'     => 'required',
            'n_kredit'    => 'required',
        ]);

        // simpan data
        Pengguna::updateOrCreate(['id' => $request->id],
        [
            'nama'                      => $request->nama,
            'lr_id_account_debit'       => $request->debit,
            'lr_id_account_kredit'      => $request->kredit,
            'n_id_account_debit'        => $request->n_debit,
            'n_id_account_kredit'       => $request->n_kredit,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success','Data berhasil disimpan');
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
        $data = Pengguna::with([
            'account_debit',
            'account_kredit',
            'n_account_debit',
            'n_account_kredit'
        ])->select('id','nama','lr_id_account_debit','lr_id_account_kredit','n_id_account_debit','n_id_account_kredit')
        ->find($id);

        return response()->json($data);
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
        // validasi
        $barang = Barang::where('id_pengguna',$id)->first();

        if($barang){
            return redirect()->route('admin.pengguna.index')->with('error','Data tidak bisa dihapus, karena sudah digunakan');
        }

        // hapus data
        Pengguna::destroy($id);

        return redirect()->route('admin.pengguna.index')->with('success','Data berhasil dihapus');
    }
}
