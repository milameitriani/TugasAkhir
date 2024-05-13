<?php 

namespace App\Repositories\Order\Graphic;

interface OrderGraphicInterface
{

    public static function countPending(): Int;

    public static function countActive(): Int;

    public static function countFinishedDaily(string $date): Int;

    public static function countIncome(): Int;

    public static function countIncomeDaily(string $date): Int;

    public static function countIncomePeriod(string $start, string $end): Int;

    public static function countIncomeMonthly(int $month, int $year): Int;

}

 ?>