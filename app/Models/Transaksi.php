<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $appends = ["background_row", "nominal_label"];

    public function getNominalLabelAttribute()
    {
        return number_format($this->nominal, 0, ",", ".");
    }

    public function getBackgroundRowAttribute()
    {
        return $this->in_out === 'in' ? 'bg-success' : 'bg-danger';
    }


    public function Wallet()
    {
        return $this->belongsTo(Wallet::class,'wallet_id','id');
    }
    public function Kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }
}
