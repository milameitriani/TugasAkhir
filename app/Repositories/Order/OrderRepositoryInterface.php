<?php 

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{

    public function filter(int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null): Object;

    public function filterByAdmin(int $admin, int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null): Object;

    public function filterByUser(int $user, int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null): Object;

    public function getLatestId(string $date): Int;

    public function findByInvoice(string $invoice): Object;

    public function updateStatus(int $id, string $status): Void;

}

 ?>