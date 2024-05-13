<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Repositories\Order\OrderRepository;
use App\Traits\Livewire\TableFilter;

class Table extends Component
{

    use TableFilter;

    public $admin, $status, $payment, $type, $table, $date, $cooking, $drink;

    protected $listeners = ['reload'];
    protected $queryString = ['page', 'status', 'cooking', 'drink'];

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

    public function confirm(OrderRepository $orderRepo, int $id)
    {
        $order = $orderRepo->update($id, ['status' => 'active', 'admin_id' => $this->admin->id]);

        $this->reload('Konfirmasi berhasil');
        $this->dispatchBrowserEvent('confirmed', [
            'invoice' => $order->invoice
        ]);
    }

    public function finish(OrderRepository $orderRepo, int $id)
    {
        $orderRepo->updateStatus($id, 'finish');

        $this->reload('Berhasil Memperbarui Status');
    }

    public function finishCook(OrderRepository $orderRepo, int $id)
    {
        $orderRepo->updateCookingStatus($id, true);

        $this->cooking = null;

        $this->reload('Berhasil Memperbarui Status Masakan');
    }

    public function finishDrink(OrderRepository $orderRepo, int $id)
    {
        $orderRepo->updateDrinkStatus($id, true);

        $this->drink = null;

        $this->reload('Berhasil Memperbarui Status Minuman');
    }

    public function mount(Request $request)
    {
        $this->status = $request->status;
        $this->admin = $request->user();
    }

    public function render(OrderRepository $orderRepo)
    {
        $menuType = null;

        if ($this->admin->can('koki')) {
            $menuType = 'food';
        }

        if ($this->admin->can('bar')) {
            $menuType = 'drink';
        }

        if ($this->status === 'pending') {
            $orders = $orderRepo->filter($this->take, $this->search, $this->status, $this->payment, $this->type, $this->table, $this->date, $this->cooking !== '' ? $this->cooking : null, $this->drink !== '' ? $this->drink : null, $menuType);
        } else {
            $status = $this->status;

            if (!$this->status && $this->admin->canany(['kasir', 'koki', 'bar'])) {
                $status = 'not-pending';
            }

            $orders = $this->admin->canany(['admin', 'kasir', 'koki', 'bar']) ?
                $orderRepo->filter(
                    $this->take,
                    $this->search,
                    $status,
                    $this->payment,
                    $this->type,
                    $this->table,
                    $this->date,
                    $this->cooking !== '' ? $this->cooking : null,
                    $this->drink !== '' ? $this->drink : null,
                    $menuType) :
                $orderRepo->filterByAdmin($this->admin->id, $this->take, $this->search, $this->status, $this->payment, $this->type, $this->table, $this->date, $this->cooking !== '' ? $this->cooking : null, $this->drink !== '' ? $this->drink : null, $menuType);
        }

        return view('livewire.admin.order.table', compact('orders'))->extends('_layouts.admin.app');
    }
}
