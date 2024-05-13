<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Repositories\Order\OrderRepository;
use App\Traits\Livewire\TableFilter;

class Table extends Component
{

    use TableFilter;

    public $user, $status, $payment, $type, $table, $date, $cooking, $drink;

    protected $listeners = ['reload'];
    protected $queryString = ['page', 'status'];

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedPayment($payment)
    {
        if ($payment === '') {
            $this->payment = null;
        }

        $this->resetPage();
    }

    public function updatedType()
    {
        $this->resetPage();
    }

    public function updatedTable()
    {
        $this->resetPage();
    }

    public function updatedDate()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->search = null;
        $this->status = null;
        $this->payment = null;
        $this->type = null;
        $this->table = null;
        $this->date = null;

        $this->resetPage();
        $this->dispatchBrowserEvent('reset');
    }

    public function mount(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:pending,active,finish'
        ]);

        $this->status = $request->status;
        $this->user = $request->user();
    }

    public function render(OrderRepository $orderRepo)
    {
        $orders = $orderRepo->filterByUser($this->user->id, $this->take, $this->search, $this->status, $this->payment, $this->type, $this->table, $this->date, $this->cooking != '' ? $this->cooking : null, $this->drink != '' ? $this->drink : null);

        return view('livewire.order.table', compact('orders'))->extends('_layouts.app');
    }
}
