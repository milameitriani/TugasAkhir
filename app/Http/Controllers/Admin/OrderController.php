<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

use App\Repositories\Order\OrderRepository;

class OrderController extends Controller
{

    public function detail(OrderRepository $orderRepo, string $invoice): View
    {
        $order = $orderRepo->findByInvoice($invoice);

        $this->authorize('viewAdmin', $order);

        return view('admin.order.detail', compact('order'));
    }

    public function print(OrderRepository $orderRepo, string $invoice): View
    {
        $order = $orderRepo->findByInvoice($invoice);
        
        $this->authorize('viewAdmin', $order);

        return view('admin.order.print', compact('order'));
    }

    public function printUpdate(\Illuminate\Http\Request $request, OrderRepository $orderRepo, string $invoice): View
    {
        $order = $orderRepo->findByInvoice($invoice);
        $carts = collect(json_decode($request->cookie('update-order-menus')));
        
        $this->authorize('viewAdmin', $order);

        return view('admin.order.print-update', compact('order', 'carts'));
    }

    public function printPerType(OrderRepository $orderRepo, string $invoice): View
    {
        $order = $orderRepo->findByInvoice($invoice);
        
        $this->authorize('viewAdmin', $order);

        return view('admin.order.print-per-type', compact('order'));
    }

}
