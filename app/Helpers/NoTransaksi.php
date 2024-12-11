<?php

use App\Models\DataTransaksi;

function NoTransaksi($tanggal_transaksi)
{
    //create no_transaksi
    $tanggal        = date('Y-m-d', strtotime($tanggal_transaksi));
    $pecah_tanggal  = explode("-", $tanggal);
    $tanggal_gabung = implode("", $pecah_tanggal);

    $cek_transaksi  = DataTransaksi::select('no_transaksi')->where('no_transaksi', 'like', '%' . $tanggal_gabung . '%')->orderByDesc('no_transaksi')->first();

    if ($cek_transaksi) {

        $pecah_no_transaksi_terakhir = explode(".", $cek_transaksi->no_transaksi);
        $id_pecah_no_transaksi_terakhir = $pecah_no_transaksi_terakhir['1'];
        $id_pecah_no_transaksi_terakhir = $id_pecah_no_transaksi_terakhir + 1;

        if ($id_pecah_no_transaksi_terakhir <= 9) {
            $id_pecah_no_transaksi_terakhir = "000" . $id_pecah_no_transaksi_terakhir;
        } else if ($id_pecah_no_transaksi_terakhir <= 99) {
            $id_pecah_no_transaksi_terakhir = "00" . $id_pecah_no_transaksi_terakhir;
        } else if ($id_pecah_no_transaksi_terakhir <= 999) {
            $id_pecah_no_transaksi_terakhir = "0" . $id_pecah_no_transaksi_terakhir;
        }

        $no_transaksi = $tanggal_gabung . "." . $id_pecah_no_transaksi_terakhir;
        
    } else {
        $no_transaksi = $tanggal_gabung . ".0000";
    }

    return $no_transaksi;
}
