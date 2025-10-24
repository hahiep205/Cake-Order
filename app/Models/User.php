<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'session_token'
    ];

    protected $hidden = [
        'password',
        'session_token'
    ];

    // Func tạo session, dùng khi login, register
    public function createSession(): string
    {
        $token = Str::random(64);
        $this->update(['session_token' => $token]);
        return $token;
    }

    public function destroySession(): void
    {
        $this->update(['session_token' => null]);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

/*
     *** Relationship với Orders table
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }

}
