<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Traits\Livewire\OrderCart;

class Cart extends Component
{

    use OrderCart;

    public $key = 'admin';

    protected $listeners = ['store'];

    public function redirectProcess()
    {
        redirect()->route('admin.orders.process');
    }

    public function mount(Request $request) {
        $menus = json_decode($request->cookie('carts-'.$this->key));

        $this->setMenus($menus ?? []);
    }

    public function render()
    {
        return view('livewire.admin.order.cart')->extends('_layouts.admin.order');
    }
}
