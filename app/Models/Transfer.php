<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
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
        return $this->belongsTo(Wallet::class);
    }
}
