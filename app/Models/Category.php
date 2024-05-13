<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getTypeNameAttribute() : string {
        return $this->type === 'food' ? 'Makanan' : 'Minuman';
    }
}
