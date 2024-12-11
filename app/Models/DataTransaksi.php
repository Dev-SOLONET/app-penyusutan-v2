<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'keterangan',
        'nominal',
        'id_register',
        'id_account',
        'DK',
        'id_temp',
        'ekstra'
    ];

    protected $table = 'data_transaksi';

    public $timestamps = false;
    
    protected $connection = 'appsolon_app';
}
