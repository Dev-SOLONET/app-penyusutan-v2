<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
    ];   

    public function barang(){
        return $this->hasMany(barang::class);
    }

    protected $table = 'satuan';
}
