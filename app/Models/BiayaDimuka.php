<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaDimuka extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_temp',
        'nama',
        'tgl',
        'tgl_akhir',
        'nominal',
        'n_id_account_debit',
        'n_id_account_kredit',
        'lr_id_account_debit',
        'lr_id_account_kredit',
    ];

    protected $table = 'biaya_dimuka';

    public function account_debit(){
        return $this->hasOne(Account::class, 'id_account', 'lr_id_account_debit');
    }

    public function account_kredit(){
        return $this->hasOne(Account::class, 'id_account', 'lr_id_account_kredit');
    }
}
