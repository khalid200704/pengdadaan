<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'keterangan', 'jumlah', 'tipe', 'tanggal'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
