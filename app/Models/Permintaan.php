<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'nomor_permintaan',
        'user_id',
        'judul_permintaan',
        'deskripsi',
        'total_estimasi',
        'status',
        'keterangan',
        'catatan_approver',
        'approved_by',
        'approved_at',
        'tanggal_permintaan'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'tanggal_permintaan' => 'datetime',
        'total_estimasi' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }



    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'menunggu_persetujuan' => 'Menunggu Persetujuan',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            default => $this->status
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'menunggu_persetujuan' => 'warning',
            'disetujui' => 'success',
            'ditolak' => 'danger',
            default => 'secondary'
        };
    }



    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class);
    }



    public function scopePending($query)
    {
        return $query->where('status', 'menunggu_persetujuan');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'ditolak');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
} 