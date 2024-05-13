<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'address',
        'phone',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute(string $password): Void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getRoleBadgeAttribute(): String
    {
        switch ($this->role) {
            case 'admin':
                return badge(['success', 'admin']);
                break;
            case 'kasir':
                return badge(['warning', 'kasir']);
                break;
            case 'pelayanan':
                return badge(['primary', 'pelayanan']);
                break;
            case 'koki':
                return badge(['danger', 'koki']);
                break;
            case 'bar':
                return badge(['info', 'bar']);
                break;
        }
    }
}
