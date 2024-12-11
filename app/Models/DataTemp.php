<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_temp',
        'tanggal',
        'keterangan',
        'no_log_pembayaran',
        'nominal',
        'id_account',
        'id_register',
        'in_out',
        'status',
        'ekstra',
        'mitra',
    ]; 

    public $timestamps = false;

    protected $connection = 'appsolon_app';

    protected $table = 'data_temp';

}
