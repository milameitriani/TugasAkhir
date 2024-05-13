<?php 

namespace App\Repositories\Order\Report;

use App\Models\Order;

class OrderReport implements OrderReportInterface
{

    protected $model;
    protected $relation = ['admin', 'user', 'table'];

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function byDate(string $date): Object
    {
        return $this->model->finished()->with($this->relation)->byDay($date)->get();
    }

    public function byMonth(int $month, int $year): Object
    {
        return $this->model->finished()->with($this->relation)->byMonth($month, $year)->get();
    }

    public function byPeriod(string $start, string $end): Object
    {
        return $this->model->finished()->with($this->relation)->byPeriod($start, $end)->get();
    }

    public function all(): Object
    {
        return $this->model->get();
    }

}

 ?>