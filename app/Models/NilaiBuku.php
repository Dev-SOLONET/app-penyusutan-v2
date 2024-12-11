<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'tgl',
        'bulan',
        'akumulasi',
        'nilai_buku',
    ]; 

    public function barang(){
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }

    protected $table = 'nilai_buku';

}
