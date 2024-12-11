<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BiayaTetap;
use App\Models\DataTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BiayaTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // param filter
        if($request->has(('tahun'))){
            $tahun = $request->get('tahun');
        }else{
            $tahun = date('Y');
        }

        $account_debit  = $request->get('account_debit') ?? '0';
        $account_kredit = $request->get('account_kredit') ?? '0';
        
        $data = BiayaTetap::with('account_debit', 'account_kredit')
            ->whereYear('tgl', $tahun)
            ->when($request->get('account_debit'), function($query) use ($request){
                return $query->where('id_account_debit', $request->get('account_debit'));
            })
            ->when($request->get('account_kredit'), function($query) use ($request){
                return $query->where('id_account_kredit', $request->get('account_kredit'));
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('management.biaya-tetap.index', [
            'title' => 'Data Biaya Tetap',
            'data'  => $data,
            'tahun' => $tahun,
            'account_debit' => $account_debit,
            'account_kredit' => $account_kredit,
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
            'nama'                => 'required',
            'tgl'                 => 'required|date',
            'tgl_akhir'           => 'required|after_or_equal:tgl',
            'nominal'             => 'required',
            'id_account_debit'    => 'required',
            'id_account_kredit'   => 'required',
        ]);

        // ketika ingin update data
        if($request->has('id')){
            return $this->update($request, $request->id);
        }

        // hitung selisih bulan dari tgl dan tgl_akhir dengan carbon
        $tgl        = Carbon::parse($request->tgl);
        $tgl_akhir  = Carbon::parse($request->tgl_akhir);
        $selisih    = $tgl->diffInMonths($tgl_akhir);
        // bulatkan ke atas
        $selisih = ceil($selisih);

        // insert data loop sebanyak selisih bulan
        DB::beginTransaction();

        try {

            for ($i = 0; $i < $selisih; $i++) {
                // buat tanggal baru dengan carbon
                $tanggal = $tgl->addMonths($i);
                
                // buat NoTransaksi
                $no_transaksi = NoTransaksi($tanggal);

                $debit = DataTransaksi::Create([
                    'no_transaksi'      => $no_transaksi,
                    'tanggal'           => $tanggal->format('Y-m-d'),
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'id_account'        => $request->id_account_debit,
                    'DK'                => 'D',
                    'id_temp'           => null,
                    'ekstra'            => ''
                ]);

                $kredit = DataTransaksi::Create([
                    'no_transaksi'      => $no_transaksi,
                    'tanggal'           => $tanggal->format('Y-m-d'),
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'id_account'        => $request->id_account_kredit,
                    'DK'                => 'K',
                    'id_temp'           => null,
                    'ekstra'            => ''
                ]);

                $id_transaksi[] = $debit->id;
                $id_transaksi[] = $kredit->id;
            }

            BiayaTetap::Create([
                'id_transaksi'          => json_encode($id_transaksi),
                'nama'                  => $request->nama,
                'tgl'                   => $request->tgl,
                'tgl_akhir'             => $request->tgl_akhir,
                'nominal'               => $request->nominal,
                'id_account_debit'      => $request->id_account_debit,
                'id_account_kredit'     => $request->id_account_kredit,
            ]);

            DB::commit();

            return redirect()->route('management.biaya-tetap.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('management.biaya-tetap.index')->with('error', 'Data gagal disimpan ' . $e->getMessage());
        }
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
        $data = BiayaTetap::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // find old data
        $old_data = BiayaTetap::find($id);

        // delete old data
        $id_transaksi = json_decode($old_data->id_transaksi);

        DB::beginTransaction();

        try {

            DataTransaksi::whereIn('id_transaksi', $id_transaksi)->delete();

            // hitung selisih bulan dari tgl dan tgl_akhir dengan carbon
            $tgl        = Carbon::parse($request->tgl);
            $tgl_akhir  = Carbon::parse($request->tgl_akhir);
            $selisih    = $tgl->diffInMonths($tgl_akhir);
            // bulatkan ke atas
            $selisih = ceil($selisih);

            // insert data loop sebanyak selisih bulan
            for ($i = 0; $i < $selisih; $i++) {
                // buat tanggal baru dengan carbon
                $tanggal = $tgl->addMonths($i);
                
                // buat NoTransaksi
                $no_transaksi = NoTransaksi($tanggal);

                $debit = DataTransaksi::Create([
                    'no_transaksi'      => $no_transaksi,
                    'tanggal'           => $tanggal->format('Y-m-d'),
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'id_account'        => $request->id_account_debit,
                    'DK'                => 'D',
                    'id_temp'           => null,
                    'ekstra'            => ''
                ]);

                $kredit = DataTransaksi::Create([
                    'no_transaksi'      => $no_transaksi,
                    'tanggal'           => $tanggal->format('Y-m-d'),
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'id_account'        => $request->id_account_kredit,
                    'DK'                => 'K',
                    'id_temp'           => null,
                    'ekstra'            => ''
                ]);

                $id_transaksi[] = $debit->id;
                $id_transaksi[] = $kredit->id;
            }

            BiayaTetap::find($id)->update([
                'id_transaksi'          => json_encode($id_transaksi),
                'nama'                  => $request->nama,
                'tgl'                   => $request->tgl,
                'tgl_akhir'             => $request->tgl_akhir,
                'nominal'               => $request->nominal,
                'id_account_debit'      => $request->id_account_debit,
                'id_account_kredit'     => $request->id_account_kredit,
            ]);

            DB::commit();

            return redirect()->route('management.biaya-tetap.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('management.biaya-tetap.index')->with('error', 'Data gagal diupdate ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // validasi data
        $data = BiayaTetap::find($id);

        if($data->created_at <= '2025-01-01 00:00:00'){
            return redirect()->route('management.biaya-tetap.index')->with('error', 'Data gagal dihapus, data tahun tersebut tidak bisa dihapus');
        }

        $id_transaksi = json_decode($data->id_transaksi);

        DB::beginTransaction();

        try {

            DataTransaksi::whereIn('id_transaksi', $id_transaksi)->delete();

            $data->delete();

            DB::commit();

            return redirect()->route('management.biaya-tetap.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('management.biaya-tetap.index')->with('error', 'Data gagal dihapus ' . $e->getMessage());
        }
    }
}
