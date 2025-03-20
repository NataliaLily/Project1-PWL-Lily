<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function Wallet()
    {
        return $this->belongsTo(Wallet::class,'wallet_id','id');
    }
    public function Kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
}
