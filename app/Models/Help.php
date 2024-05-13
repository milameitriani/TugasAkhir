<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function getContentParsedAttribute(): String
    {
        return nl2br($this->content);
    }
}
