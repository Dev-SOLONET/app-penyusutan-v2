<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'no_invoice',
        'nama',
        'tgl_beli',
        'jumlah',
        'id_satuan',
        'id_pengguna',
        'harga_satuan',
        'harga_total',
        'umur',
        'biaya_penyusutan',
        'aktif',
        'keterangan',
    ]; 

    public function pengguna()
    {
        return $this->BelongsTo(Pengguna::class,'id_pengguna');
    }

    public function satuan()
    {
        return $this->BelongsTo(Satuan::class,'id_satuan');
    }

    public function nilai_buku()
    {
        return $this->BelongsTo(NilaiBuku::class,'id','id_barang');
    }

    protected $table = 'barang';
}
