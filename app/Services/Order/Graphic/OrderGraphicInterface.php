<?php 

namespace App\Services\Order\Graphic;

interface OrderGraphicInterface
{

    public static function order(): Array;

    public static function income(): Array;

    public static function countIncome(string $type = null): Int;

}

 ?>