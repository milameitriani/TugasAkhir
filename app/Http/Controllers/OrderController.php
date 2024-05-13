<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

use App\Repositories\Order\OrderRepository;

class OrderController extends Controller
{

    public function detail(OrderRepository $orderRepo, string $invoice): View
    {
        $order = $orderRepo->findByInvoice($invoice);

        $this->authorize('view', $order);

        return view('order.detail', compact('order'));
    }

}
