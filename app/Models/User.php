<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'divisi',
        'jabatan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class);
    }

    public function approvedPermintaan()
    {
        return $this->hasMany(Permintaan::class, 'approved_by');
    }



    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDivisionHead()
    {
        return $this->role === 'division_head';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function canApprove()
    {
        return in_array($this->role, ['admin', 'division_head']);
    }

    public function canManageBudget()
    {
        return in_array($this->role, ['admin', 'division_head']);
    }
}
