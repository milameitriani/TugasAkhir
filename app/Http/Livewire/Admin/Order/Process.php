<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use App\Traits\Livewire\OrderProcess;
use App\Models\Order;

class Process extends Component
{

    use OrderProcess;

    public $status = 'active';
    public $key = 'admin';

    public function mounted()
    {
        $this->admin_id = user('id');
    }

    public function user(): Int
    {
        return user('id');
    }

    public function redirectBack()
    {
        redirect()->route('admin.orders.create');
    }

    public function afterSuccess(string $invoice)
    {
        $this->dispatchBrowserEvent('saved', [
            'invoice' => $invoice,
            'update' => !!$this->order,
            'withPrint' => auth()->user()->can('pelayanan')
        ]);
    }

    public function updatedType(string $type)
    {
        $this->status = $type === 'take-away' ? 'finish' : 'active';
    }

    public function updatedTableId($value) {
        $order = Order::whereTableId($value)->has('user')->with('user', 'menus')->first();

        $this->order = $order ?? null;
        $this->user_id = $order ? $order->user_id : null;

        $this->dispatchBrowserEvent('updated-user-id', [
            'user' => $order ? $order->user : null
        ]);
        $this->setMenusFromCookies();
    }

    public function render()
    {
        return view('livewire.admin.order.process')->extends('_layouts.admin.app');
    }
}
