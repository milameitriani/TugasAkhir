<?php 

namespace App\Services\Order\Graphic;

use App\Repositories\Order\Graphic\OrderGraphic as OrderGraphicRepository;

class OrderGraphic implements OrderGraphicInterface
{

    public static function order(): Array
    {
        $date = [];
        $order = [];

        for ($i=6; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime('- '.$i.' days'));

            array_push($order, OrderGraphicRepository::countFinishedDaily($day));
            array_push($date, $day);
        }

        return compact('date', 'order');
    }

    public static function income(): Array
    {
        $date = [];
        $income = [];

        for ($i=6; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime('- '.$i.' days'));

            array_push($income, OrderGraphicRepository::countIncomeDaily($day));
            array_push($date, $day);
        }

        return compact('date', 'income');
    }

    public static function countIncome(string $type = null): Int
    {
        $orderGraphicRepo = OrderGraphicRepository::class;

        switch ($type) {
            case 'all':
                $income = $orderGraphicRepo::countIncome();
                break;

            case 'week':
                $income = $orderGraphicRepo::countIncomePeriod(date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week')));
                break;

            case 'month':
                $income = $orderGraphicRepo::countIncomeMonthly(date('m'), date('Y'));
                break;
            
            default:
                $income = $orderGraphicRepo::countIncomeDaily(date('Y-m-d'));
                break;
        }

        return $income;
    }

}

 ?>