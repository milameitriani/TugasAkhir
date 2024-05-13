<?php 

namespace App\Traits\Livewire;

trait OrderPayment
{

    public $order, $subtotal, $total, $grandtotal, $discount, $discountVal, $paid, $paidVal, $fine, $tax, $payment_method, $payment_method_name, $additional_price, $has_additional_price;
    public $payment_status = true;
    public $status = 'finish';

    public function rules(): Array
    {
        return [
            'discount' => 'nullable|integer|lt:grandtotal',
            'paid' => 'required|integer|gte:total',
            'status' => 'required|in:pending,active,finish',
            'payment_status' => 'required|boolean',
            'payment_method' => 'required|in:cash,qris,bca',
            'additional_price' => 'nullable|integer',
        ];
    }

    public function countFine()
    {
        $this->fine = max((int)$this->paid - $this->total, 0);
    }

    public function updatedDiscountVal($discount)
    {
        $discount = (int)preg_replace('/\D/i', '', $discount);
        
        $this->discount = $discount;
        $this->discountVal = number_format($discount);
        $this->total = max($this->grandtotal - $discount, 0);

        $this->countFine();
    }

    public function updatedPaidVal($paid)
    {
        $paid = (int)preg_replace('/\D/i', '', $paid);

        $this->paid = $paid;
        $this->paidVal = number_format($paid);

        $this->countFine();
    }

    public function updatedPaymentMethod() {
        $this->has_additional_price = $this->payment_method === 'bca';
        $this->additional_price = $this->has_additional_price ? ($this->total * 1 / 100) : 0;
        $this->total = $this->grandtotal + $this->additional_price;
    }

}

 ?>