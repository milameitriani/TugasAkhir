<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

use App\Traits\Livewire\OrderPayment;
use App\Services\Order\OrderService;

class Payment extends Component
{

    use OrderPayment;

    public $menus;
    public $key;

    protected $listeners = ['payment' => 'open'];

    public function countTotal()
    {
        $total = collect($this->menus)->sum(function ($item)
        {
            return $item['menu']['price'] * $item['qty'];
        });
        $tax = $total * 15 / 100;
        $has_additional_price = $this->payment_method === 'bca';
        $additional_price = $has_additional_price ? $total * 1 / 100 : 0;
        $grand_total = $total + $tax + $additional_price;

        $this->subtotal = $total;
        $this->grandtotal = $grand_total;
        $this->total = $grand_total;
        $this->tax = $tax;
        $this->payment_method_name = getPaymentMethodName($this->payment_method);
        $this->additional_price = $additional_price;
        $this->has_additional_price = $has_additional_price;
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

    public function resetCarts()
    {
        Cookie::queue(Cookie::forget('carts-'.$this->key));
    }

    public function open(array $menus, array $order, string $key)
    {
        $this->reset();
        $this->resetValidation();

        $this->menus = $menus;
        $this->order = $order;
        $this->status = $order['status'];
        $this->payment_method = $order['payment_method'];
        $this->key = $key;

        $this->countTotal();

        $this->dispatchBrowserEvent('open-payment');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-payment');
    }

    public function save(OrderService $orderService)
    {
        $data = $this->validate();
        $data = array_merge($this->order, $data);

        $order = $orderService->create($data, $this->getMenus());

        $this->resetCarts();

        redirect()->route('admin.orders.detail', $order->invoice);
    }

    public function render()
    {
        return view('livewire.admin.order.payment');
    }
}
