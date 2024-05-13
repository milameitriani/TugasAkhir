<?php 

namespace App\Repositories\Order\Report;

interface OrderReportInterface
{

    public function byDate(string $date): Object;

    public function byMonth(int $month, int $year): Object;

    public function byPeriod(string $start, string $end): Object;

    public function all(): Object;

}

 ?>