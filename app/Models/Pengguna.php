<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'lr_id_account_debit',
        'lr_id_account_kredit',
        'n_id_account_debit',
        'n_id_account_kredit'
    ]; 

    public function barang(){
        return $this->hasMany(barang::class);
    }

    public function account_debit(){
        return $this->hasOne(Account::class, 'id_account', 'lr_id_account_debit');
    }

    public function account_kredit(){
        return $this->hasOne(Account::class, 'id_account', 'lr_id_account_kredit');
    }

    public function n_account_debit(){
        return $this->hasOne(Account::class, 'id_account', 'n_id_account_debit');
    }

    public function n_account_kredit(){
        return $this->hasOne(Account::class, 'id_account', 'n_id_account_kredit');
    }
    
    protected $table = 'pengguna';
}
