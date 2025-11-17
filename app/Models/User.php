<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // <--- tambahkan ini

class User extends Authenticatable
{
    use Notifiable, HasRoles; // <--- tambahkan HasRoles di sini

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin'); // <--- gunakan Spatie, bukan field role
    }

    public function isDoctor()
    {
        return $this->hasRole('doctor');
    }

    public function isPatient()
    {
        return $this->hasRole('patient');
    }
}
