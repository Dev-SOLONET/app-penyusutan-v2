<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaTetap extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'nama',
        'tgl',
        'tgl_akhir',
        'nominal',
        'id_account_debit',
        'id_account_kredit',
    ];

    public function account_debit(){
        return $this->hasOne(Account::class, 'id_account', 'id_account_debit');
    }

    public function account_kredit(){
        return $this->hasOne(Account::class, 'id_account', 'id_account_kredit');
    }

    protected $table = 'biaya_tetap';

}