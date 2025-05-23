<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',


    ];
    protected $appends = [ 'saldo' ];

    protected $with = ['Jurnal'];
        
    public function getSaldoAttribute()
    {
        $saldo = $this->Jurnal()
            ->where('wallet_id', $this->id)
            ->sum('nominal');
        return $saldo;
    }

    public function Jurnal(){
        return $this->hasMany(Jurnal::class);
    }
}

