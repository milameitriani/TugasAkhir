<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'photo', 'description', 'category_id', 'type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPhotoSrcAttribute(): String
    {
        return local($this->photo, 'menus');
    }
    
    public function getExcerptAttribute(): String
    {
        return Str::words($this->description, 8);
    }

    public function getPriceFormattedAttribute(): String
    {
        return number_format($this->price);
    }

    public function getTypeNameAttribute() : string {
        return $this->type === 'food' ? 'Makanan' : 'Minuman';
    }

}
