<?php 

namespace App\Services\Order;

interface OrderServiceInterface
{

  public function getInvoice(): String;

  public function create(array $data, array $menus): Object;

}

 ?>