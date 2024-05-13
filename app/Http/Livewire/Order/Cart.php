<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use App\Traits\Livewire\OrderCart;

class Cart extends Component
{

    use OrderCart;

    public $key = 'user';

    protected $listeners = ['store'];

    public function redirectProcess()
    {
        redirect()->route('order.process');
    }

    public function mount(Request $request) {
        $menus = json_decode($request->cookie('carts-'.$this->key));

        $this->setMenus($menus ?? []);
    }

    public function render()
    {
        return view('livewire.order.cart')->extends('_layouts.order');
    }
}
