<?php 

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;

class OrderService
{

  protected $orderRepo;

  public function __construct(OrderRepository $orderRepo)
  {
    $this->orderRepo = $orderRepo;
  }

  public function getInvoice(int $admin): String
  {
    $id = $this->orderRepo->getLatestId(date('Y-m-d'));

    return sprintf('%05d-%d-%06d', $id + 1, $admin, date('dmy'));
  }

  public function create(array $data, array $menus): Object
  {
    $order = $this->orderRepo->create($data);

    $order->menus()->attach($menus);

    return $order;
  }

  public function update($order, array $data, array $menus): Object
  {
    $order->update($data);
    $order->menus()->sync($menus);

    return $order;
  }

}

 ?>