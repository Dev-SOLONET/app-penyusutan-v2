<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\BiayaDimuka;
use App\Models\DataTemp;
use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use DateTime;

class BiayaDimukaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('from') && $request->has('to')) {
            $data = BiayaDimuka::with(['account_debit', 'account_kredit'])->where('tgl', '>=', $request->get('from'))
                ->where('tgl', '<=', $request->get('to'))
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $data = BiayaDimuka::with(['account_debit', 'account_kredit'])->where('tgl', '>=', date('Y-01-01'))
                ->where('tgl', '<=', date('Y-12-31'))
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        $account = Account::select('id_account', 'nama_account')
            ->orderBy('nama_account')
            ->get();

        return view('management.biaya-dimuka.index', [
            'title'     => 'Data Biaya Dimuka',
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
        $request->validate([
            'nama'          => 'required',
            'tgl'           => 'required|date',
            'tgl_akhir'     => 'required|after_or_equal:tgl',
            'nominal'       => 'required',
            'n_id_account_debit'    => 'required',
            'n_id_account_kredit'   => 'required',
            'lr_id_account_debit'   => 'required',
            'lr_id_account_kredit'  => 'required',
        ]);

        if($request->id){
            return $this->update($request, $request->id);
        }

        DB::beginTransaction();

        try {

            // Ketika dibayarkan dengan KAS, maka kas billing akan dikurangi
            if ($request->n_id_account_kredit == '1') {

                $id_temp = DataTemp::Create([
                    'tanggal'           => $request->tgl,
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'no_log_pembayaran' => '',
                    'id_account'        => $request->n_id_account_kredit,
                    'in_out'            => 'o',
                    'status'            => 'sudah',
                    'ekstra'            => 'access',
                    'mitra'             =>  null,
                ]);

                $id_temp = $id_temp->id;
            } else {
                $id_temp = null;
            }

            $no_transaksi = NoTransaksi($request->tgl);

            // neraca
            $debit = DataTransaksi::Create([
                'no_transaksi'      => $no_transaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => $request->nama,
                'nominal'           => $request->nominal,
                'id_register'       => null,
                'id_account'        => $request->n_id_account_debit,
                'DK'                => 'D',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $kredit = DataTransaksi::Create([
                'no_transaksi'      => $no_transaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => $request->nama,
                'nominal'           => $request->nominal,
                'id_register'       => null,
                'id_account'        => $request->n_id_account_kredit,
                'DK'                => 'K',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $id_transaksi[] = $debit->id;
            $id_transaksi[] = $kredit->id;

            //laba rugi
            //hitung penyusutan perbulan
            $tgl1 = new DateTime($request->tgl);
            $tgl2 = new DateTime($request->tgl_akhir);

            $jarak = $tgl2->diff($tgl1);

            if ($jarak->y > 0) {
                $bulan = $jarak->y * 12;
                $total_bulan = $jarak->m + $bulan;
                $penyusutan = round($request->nominal / $total_bulan);
            } elseif ($jarak->m > 0) {
                $penyusutan = round($request->nominal / $jarak->m);
            } else {
                $penyusutan = $request->nominal;
            }

            //buat id transaksi baru agar tidak crash di aplikasi lama
            $new_idtransaksi = NoTransaksi($request->tgl);

            $debit = DataTransaksi::Create([
                'no_transaksi'      => $new_idtransaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => 'Penyusutan ' . $request->nama,
                'nominal'           => $penyusutan,
                'id_register'       => null,
                'id_account'        => $request->lr_id_account_debit,
                'DK'                => 'D',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $kredit = DataTransaksi::Create([
                'no_transaksi'      => $new_idtransaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => 'Penyusutan ' . $request->nama,
                'nominal'           => $penyusutan,
                'id_register'       => null,
                'id_account'        => $request->lr_id_account_kredit,
                'DK'                => 'K',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $id_transaksi[] = $debit->id;
            $id_transaksi[] = $kredit->id;

            BiayaDimuka::Create(
                [
                    'id_transaksi'  => json_encode($id_transaksi),
                    'id_temp'       => $id_temp,
                    'nama'          => $request->nama,
                    'tgl'           => $request->tgl,
                    'tgl_akhir'     => $request->tgl_akhir,
                    'nominal'       => $request->nominal,
                    'lr_id_account_debit'     => $request->lr_id_account_debit,
                    'lr_id_account_kredit'    => $request->lr_id_account_kredit,
                    'n_id_account_debit'      => $request->n_id_account_debit,
                    'n_id_account_kredit'     => $request->n_id_account_kredit,
                ]
            );

            DB::commit();

            return redirect()->route('management.biaya-dimuka.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('management.biaya-dimuka.index')->with('error', 'Data gagal disimpan ' . $e->getMessage());
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
        return BiayaDimuka::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $old_data = BiayaDimuka::find($id);

            $id_transaksi = json_decode($old_data->id_transaksi);

            // delete old data
            DataTransaksi::whereIn('id_transaksi', $id_transaksi)->delete();
            if ($old_data->id_temp != null) {
                DataTemp::where('id_temp', $old_data->id_temp)->delete();
            }

            $id_transaksi = [];

            // Ketika dibayarkan dengan KAS, maka kas billing akan dikurangi
            if ($request->n_id_account_kredit == '1') {

                $id_temp = DataTemp::Create([
                    'tanggal'           => $request->tgl,
                    'keterangan'        => $request->nama,
                    'nominal'           => $request->nominal,
                    'id_register'       => null,
                    'no_log_pembayaran' => '',
                    'id_account'        => $request->n_id_account_kredit,
                    'in_out'            => 'o',
                    'status'            => 'sudah',
                    'ekstra'            => 'access',
                    'mitra'             =>  null,
                ]);

                $id_temp = $id_temp->id;

            } else {
                $id_temp = null;
            }

            $no_transaksi = NoTransaksi($request->tgl);

            // neraca
            $debit = DataTransaksi::Create([
                'no_transaksi'      => $no_transaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => $request->nama,
                'nominal'           => $request->nominal,
                'id_register'       => null,
                'id_account'        => $request->n_id_account_debit,
                'DK'                => 'D',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $kredit = DataTransaksi::Create([
                'no_transaksi'      => $no_transaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => $request->nama,
                'nominal'           => $request->nominal,
                'id_register'       => null,
                'id_account'        => $request->n_id_account_kredit,
                'DK'                => 'K',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $id_transaksi[] = $debit->id;
            $id_transaksi[] = $kredit->id;

            //laba rugi
            //hitung penyusutan perbulan
            $tgl1 = new DateTime($request->tgl);
            $tgl2 = new DateTime($request->tgl_akhir);

            $jarak = $tgl2->diff($tgl1);

            if ($jarak->y > 0) {
                $bulan = $jarak->y * 12;
                $total_bulan = $jarak->m + $bulan;
                $penyusutan = round($request->nominal / $total_bulan);
            } elseif ($jarak->m > 0) {
                $penyusutan = round($request->nominal / $jarak->m);
            } else {
                $penyusutan = $request->nominal;
            }

            //buat id transaksi baru agar tidak crash di aplikasi lama
            $new_idtransaksi = NoTransaksi($request->tgl);

            $debit = DataTransaksi::Create([
                'no_transaksi'      => $new_idtransaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => 'Penyusutan ' . $request->nama,
                'nominal'           => $penyusutan,
                'id_register'       => null,
                'id_account'        => $request->lr_id_account_debit,
                'DK'                => 'D',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $kredit = DataTransaksi::Create([
                'no_transaksi'      => $new_idtransaksi,
                'tanggal'           => $request->tgl,
                'keterangan'        => 'Penyusutan ' . $request->nama,
                'nominal'           => $penyusutan,
                'id_register'       => null,
                'id_account'        => $request->lr_id_account_kredit,
                'DK'                => 'K',
                'id_temp'           => null,
                'ekstra'            => ''
            ]);

            $id_transaksi[] = $debit->id;
            $id_transaksi[] = $kredit->id;

            $old_data->update(
                [
                    'id_transaksi'  => json_encode($id_transaksi),
                    'id_temp'       => $id_temp,
                    'nama'          => $request->nama,
                    'tgl'           => $request->tgl,
                    'tgl_akhir'     => $request->tgl_akhir,
                    'nominal'       => $request->nominal,
                    'lr_id_account_debit'     => $request->lr_id_account_debit,
                    'lr_id_account_kredit'    => $request->lr_id_account_kredit,
                    'n_id_account_debit'      => $request->n_id_account_debit,
                    'n_id_account_kredit'     => $request->n_id_account_kredit,
                ]
            );

            DB::commit();

            return redirect()->route('management.biaya-dimuka.index')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('management.biaya-dimuka.index')->with('error', 'Data gagal diubah ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
