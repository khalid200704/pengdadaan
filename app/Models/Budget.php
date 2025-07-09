<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_budget',
        'total_budget',
        'terpakai',
        'tersisa',
        'tahun',
        'keterangan'
    ];

    protected $casts = [
        'total_budget' => 'decimal:2',
        'terpakai' => 'decimal:2',
        'tersisa' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($budget) {
            $budget->tersisa = $budget->total_budget - $budget->terpakai;
        });

        static::updating(function ($budget) {
            $budget->tersisa = $budget->total_budget - $budget->terpakai;
        });
    }

    public function getPersentaseTerpakaiAttribute()
    {
        if ($this->total_budget > 0) {
            return round(($this->terpakai / $this->total_budget) * 100, 2);
        }
        return 0;
    }
} 