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

    // Func xóa session khi logout
    public function destroySession(): void
    {
        $this->update(['session_token' => null]);
    }

    // func check xem user này có phải admin không.
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // func check xem có phải user không.
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

}
