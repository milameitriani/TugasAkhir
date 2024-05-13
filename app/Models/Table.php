<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['no'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeCountOrder($query)
    {
        $query->withCount(['orders' => function ($order)
        {
            $order->whereStatus(['active']);
        }]);
    }

    public function scopeWithOrder($query)
    {
        $query->with(['orders' => function ($order)
        {
            return $order->whereStatus(['active']);
        }]);
    }
}
