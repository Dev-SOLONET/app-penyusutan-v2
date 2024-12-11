<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    
    protected $table = 'account';
    
    protected $connection = 'appsolon_app';

    public function Pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
