<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use App\Traits\Livewire\OrderProcess;

class Process extends Component
{

    use OrderProcess;

    public $status = 'pending';
    public $key = 'user';

    public function mounted()
    {
        $this->user_id = user('id');
    }

    public function user(): Int
    {
        return user('id');
    }

    public function redirectBack()
    {
        redirect()->route('home');
    }

    public function afterSuccess(string $invoice)
    {
        redirect()->route('order.detail', $invoice);
    }

    public function render()
    {
        return view('livewire.order.process')->extends('_layouts.app');
    }
}
