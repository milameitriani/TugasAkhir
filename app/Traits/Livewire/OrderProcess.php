<?php 

namespace App\Traits\Livewire;

use App\Services\Order\OrderService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

trait OrderProcess
{

    use TableProcess;

    public $menus;
    public $type = 'dine-in';
    public $payment_method = 'cash';
    public $hasAdditionalPrice = false;
    public $invoice, $admin_id, $table_id, $user_id, $total, $tax, $grand_total, $additional_price;
    public $order;

    public function rules(): Array
    {
        return [
            'invoice' => 'required|string',
            'total' => 'required|integer',
            'grand_total' => 'required|integer',
            'tax' => 'required|integer',
            'additional_price' => 'nullable|integer',
            'payment_method' => 'required|in:cash,qris,bca',
            'type' => 'required|in:dine-in,take-away',
            'status' => 'nullable|in:pending,active,finish',
            'table_id' => 'required_unless:type,take-away|nullable|exists:tables,id',
            'admin_id' => 'nullable|exists:admins,id',
            'user_id' => 'nullable|exists:users,id'
        ];
    }

    public function mount(Request $request)
    {
        $this->setMenusFromCookies();

        if (user('table_id')) {
            $this->table_id = user('table_id');
        }
        
        $this->mounted();
    }

    public function setMenusFromCookies() {
        $orderService = app()->make(OrderService::class);
        $carts = collect(json_decode(Cookie::get('carts-'.$this->key)));

        if (!$carts) {
            $this->redirectBack();
        }

        $carts = collect($carts)->map(function ($item)
        {
            return [
                'menu' => (array) $item->menu,
                'qty' => $item->qty
            ];
        })->all();

        if ($this->order) {
            $this->order->menus->each(function ($menu) use (&$carts) {
                $index = collect($carts)->search(function ($cart) use ($menu) {
                    return $cart['menu']['id'] === $menu->id;
                });

                if ($index !== false) {
                    $carts[$index]['qty'] += $menu->pivot->quantity;
                } else {
                    array_push($carts, [
                        'menu' => $menu,
                        'qty' => $menu->pivot->quantity
                    ]);
                }
            });
        }

        $this->menus = $carts;
        $this->countTotal();

        $this->invoice = $this->order ? $this->order->invoice : $orderService->getInvoice($this->user());
    }

    public function setMenus(array $menus = null)
    {
        if (!$menus) {
            $this->redirectBack();
        }

        $this->menus = collect($menus)->map(function ($item)
        {
            return [
                'menu' => (array) $item->menu,
                'qty' => $item->qty
            ];
        })->all();
    }

    public function getMenus(): Array
    {
        $results = [];

        foreach ($this->menus as $menu) {
            $results[$menu['menu']['id']] = [
                'quantity' => $menu['qty']
            ];
        }

        return $results;
    }

    public function countTotal()
    {
        $this->total = collect($this->menus)->sum(function ($item)
        {
            return $item['menu']['price'] * $item['qty'];
        });

        $this->countTax();
        $this->countAdditionalPrice();
        $this->countGrandTotal();
    }

    public function countTax() {
        $this->tax = ($this->total * 15 / 100);
    }

    public function countGrandTotal() {
        $this->grand_total = $this->total + $this->tax + $this->additional_price;
    }

    public function countAdditionalPrice() {
        $this->additional_price = $this->hasAdditionalPrice ? ($this->total * 1 / 100) : 0;
    }

    public function updatedPaymentMethod($value) {
        $this->hasAdditionalPrice = $value === 'bca';

        $this->countTotal();
    }

    public function save(OrderService $orderService)
    {
        $data = $this->validate();
        $menus = $this->getMenus();

        if ($this->order) {
            $order = $orderService->update($this->order, $data, $menus);
        } else {
            $order = $orderService->create($data, $menus);
        }

        $this->saveUpdatedOrderCookise();

        $this->resetCarts();
        $this->afterSuccess($order->invoice);
    }

    public function saveUpdatedOrderCookise() {
        Cookie::queue('update-order-menus', Cookie::get('carts-'.$this->key));
    }

    public function payment()
    {
        $data = $this->validate();

        $this->emit('payment', $this->menus, $data, $this->key);
    }

}

 ?>