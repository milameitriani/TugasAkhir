<?php 

namespace App\Repositories\Order\Graphic;

use App\Models\Order;

class OrderGraphic implements OrderGraphicInterface
{

    public static function countPending($admin = null): Int
    {
        return Order::when($admin, function ($query) use ($admin) {
            $query->whereAdminId($admin->id);
        })->whereStatus('pending')->count();
    }

    public static function countActive(): Int
    {
        return Order::whereStatus('active')->count();
    }

    public static function countFinishedDaily(string $date): Int
    {
        return Order::finished()->byDay($date)->count();
    }

    public static function countIncome(): Int
    {
        return Order::finished()->sum('total');
    }

    public static function countIncomeDaily(string $date): Int
    {
        return Order::finished()->byDay($date)->sum('total');
    }

    public static function countIncomePeriod(string $start, string $end): Int
    {
        return Order::finished()->byPeriod($start, $end)->sum('total');
    }

    public static function countIncomeMonthly(int $month, int $year): Int
    {
        return Order::finished()->byMonth($month, $year)->sum('total');
    }

    public static function countDrink($admin, string $status = 'active', bool $drinkStatus = false) : int {
        return Order::when($admin, function ($query) use ($admin) {
            $query->whereAdminId($admin->id);
        })->whereStatus($status)->whereDrinkStatus($drinkStatus)->whereHas('menus', function ($query) {
            return $query->whereType('drink');
        })->count();
    }

    public static function countCooking($admin, string $status = 'active', bool $cookingStatus = false) : int {
        return Order::when($admin, function ($query) use ($admin) {
            $query->whereAdminId($admin->id);
        })->whereStatus($status)->whereCookingStatus($cookingStatus)->whereHas('menus', function ($query) {
            return $query->whereType('food');
        })->count();
    }

}

 ?>