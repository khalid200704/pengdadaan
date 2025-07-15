<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'permintaan_id',
        'user_id',
        'deskripsi_progress',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
