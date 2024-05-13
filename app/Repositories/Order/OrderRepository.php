<?php 

namespace App\Repositories\Order;

use App\Repositories\Repository;
use App\Models\Order;

class OrderRepository extends Repository implements OrderRepositoryInterface
{

    protected function getModel(): String
    {
        return Order::class;
    }

    public function filter(int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null, bool $cookingStatus = null, bool $drinkStatus = null, string $menuType = null): Object
    {
        return $this->model
            ->filter($invoice, $status, $paymentStatus, $type, $tableId, $date, $cookingStatus, $drinkStatus, $menuType)->with(['user', 'admin', 'table'])
            ->withCount([
                'menus as food_menus_count' => function ($query) {
                    $query->whereType('food');
                },
                'menus as drink_menus_count' => function ($query) {
                    $query->whereType('drink');
                }
            ])
            ->latest()
            ->paginate($take);
    }

    public function filterByAdmin(int $admin, int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null, bool $cookingStatus = null, bool $drinkStatus = null, string $menuType = null): Object
    {
        return $this->model
            ->whereAdminId($admin)->filter($invoice, $status, $paymentStatus, $type, $tableId, $date, $cookingStatus, $drinkStatus, $menuType)->with(['user', 'admin', 'table'])
            ->withCount([
                'menus as food_menus_count' => function ($query) {
                    $query->whereType('food');
                },
                'menus as drink_menus_count' => function ($query) {
                    $query->whereType('drink');
                }
            ])
            ->latest()
            ->paginate($take);
    }

    public function filterByUser(int $user, int $take = 10, string $invoice = null, string $status = null, bool $paymentStatus = null, string $type = null, int $tableId = null, string $date = null, bool $cookingStatus = null, bool $drinkStatus = null, string $menuType = null): Object
    {
        return $this->model
            ->whereUserId($user)
            ->filter($invoice, $status, $paymentStatus, $type, $tableId, $date, $cookingStatus, $drinkStatus, $menuType)
            ->with(['admin', 'table'])
            ->withCount([
                'menus as food_menus_count' => function ($query) {
                    $query->whereType('food');
                },
                'menus as drink_menus_count' => function ($query) {
                    $query->whereType('drink');
                }
            ])
            ->latest()
            ->paginate($take);
    }

    public function getLatestId(string $date): Int
    {
        return $this->model->whereDate('created_at', $date)->latest()->first()->id ?? 0;
    }

    public function findByInvoice(string $invoice): Object
    {
        return $this->model->whereInvoice($invoice)->with(['user', 'admin', 'menus', 'table'])->firstOrFail();
    }

    public function updateStatus(int $id, string $status): Void
    {
        $this->find($id)->update(['status' => $status]);
    }

    public function updateCookingStatus(int $id, bool $status): Void
    {
        $this->find($id)->update(['cooking_status' => $status]);
    }

    public function updateDrinkStatus(int $id, bool $status): Void
    {
        $this->find($id)->update(['drink_status' => $status]);
    }

}

 ?>