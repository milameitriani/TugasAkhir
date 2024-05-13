<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'type',
        'payment_status',
        'cooking_status',
        'status',
        'total',
        'paid',
        'discount',
        'user_id',
        'admin_id',
        'table_id',
        'drink_status',
        'grand_total',
        'tax',
        'additional_price',
        'payment_method'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withPivot('quantity');
    }

    public function scopeFinished($query)
    {
        $query->whereStatus('finish');
    }

    public function scopeByDay($query, string $date)
    {
        $query->whereDate('created_at', $date);
    }

    public function scopeByMonth($query, int $month, int $year)
    {
        $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
    }

    public function scopeByPeriod($query, string $start, string $end)
    {
        $query->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
    }

    public function scopeFilter($query, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null, bool $cookingStatus = null, bool $drinkStatus = null, string $menuType = null)
    {
        $query->where('invoice', 'like', '%'.$invoice.'%')->when($status, function ($query) use ($status)
        {
            if ($status === 'not-pending') {
                return $query->where('status', '!=', 'pending');
            }

            return $query->whereStatus($status);
        })->when(!is_null($paymentStatus), function ($query) use ($paymentStatus)
        {
            return $query->wherePaymentStatus($paymentStatus);
        })->when(!is_null($cookingStatus), function ($query) use ($cookingStatus)
        {
            return $query->whereCookingStatus($cookingStatus);
        })->when(!is_null($drinkStatus), function ($query) use ($drinkStatus)
        {
            return $query->whereDrinkStatus($drinkStatus);
        })->when($type, function ($query) use ($type)
        {
            return $query->whereType($type);
        })->when($tableId, function ($query) use ($tableId)
        {
            return $query->whereTableId($tableId);
        })->when($date, function ($query) use ($date)
        {
            return $query->whereDate('created_at', $date);
        })->when($menuType, function ($query) use ($menuType)
        {
            if ($menuType === 'food') {
                return $query->whereHas('menus', function ($query) {
                    return $query->whereType('food');
                });
            } else {
                return $query->whereHas('menus', function ($query) {
                    return $query->whereType('drink');
                });
            }
        });
    }

    public function getDateAttribute(): String
    {
        return date('d-m-Y H:i', strtotime($this->created_at));
    }

    public function getStatusBadgeAttribute(): String
    {
        $status = [];

        switch ($this->status) {
            case 'pending':
                $status = ['danger', 'pending'];
                break;

            case 'active':
                $status = ['warning', 'aktif'];
                break;
            
            default:
                $status = ['success', 'selesai'];
                break;
        }
        return badge($status);
    }

    public function getPaymentBadgeAttribute(): String
    {
        return badge($this->payment_status ? ['success', 'sudah bayar'] : ['warning', 'belum bayar']);
    }

    public function getCookingBadgeAttribute(): String
    {
        if (!$this->food_menus_count) {
            return badge(['secondary', 'Tidak Ada Makanan']);
        }

        return badge($this->cooking_status ? ['success', 'sudah jadi'] : ['warning', 'sedang dimasak']);
    }

    public function getDrinkBadgeAttribute(): String
    {
        if (!$this->drink_menus_count) {
            return badge(['secondary', 'Tidak Ada Minuman']);
        }

        return badge($this->drink_status ? ['success', 'sudah jadi'] : ['warning', 'sedang diproses']);
    }

    public function getTypeTextAttribute(): String
    {
        return $this->type === 'dine-in' ? 'Makan disini' : 'Bungkus';
    }

    public function getTypeBadgeAttribute(): String
    {
        return badge($this->type === 'dine-in' ? ['primary', 'Makan disini'] : ['secondary', 'Bungkus']);
    }

    public function getTotalFormattedAttribute(): String
    {
        return number_format($this->total);
    }

    public function getPaidFormattedAttribute(): String
    {
        return number_format($this->paid);
    }

    public function getTaxFormattedAttribute(): String
    {
        return number_format($this->tax);
    }

    public function getAdditionalPriceFormattedAttribute(): String
    {
        return number_format($this->additional_price);
    }

    public function getFineAttribute(): String
    {
        return number_format(max($this->paid - ($this->grand_total - $this->discount), 0));
    }

    public function getHasAdditionalPriceAttribute() : bool {
        return $this->payment_method === 'bca';
    }

    public function getPaymentMethodNameAttribute() {
        return getPaymentMethodName($this->payment_method);
    }
}
