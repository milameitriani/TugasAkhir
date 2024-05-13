<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use App\Traits\Livewire\OrderPayment;
use App\Repositories\Order\OrderRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class Pay extends Component
{
    use OrderPayment;

    public $order;
    public $toggle = true;

    protected $listeners = ['pay' => 'open'];

    public function updatedToggle(bool $toggle)
    {
        $this->status = $toggle ? 'finish' : 'active';
    }

    /**
 * @OA\Post(
 *     path="/api/open-payment/{orderId}",
 *     summary="Membuka form pembayaran pesanan",
 *     description="Mengambil informasi pesanan dan membuka form pembayaran.",
 *     tags={"Payment"},
 *     @OA\Parameter(
 *         name="orderId",
 *         in="path",
 *         description="ID pesanan yang akan dibuka pembayarannya.",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Berhasil membuka form pembayaran.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Form pembayaran berhasil dibuka.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pesanan tidak ditemukan.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Pesanan tidak ditemukan.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Kesalahan server.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Terjadi kesalahan saat membuka form pembayaran.")
 *         )
 *     ),
 * )
 */
    public function open(OrderRepository $orderRepo, int $orderId)
    {
        try {
            $this->reset();
            $this->resetValidation();

            $order = $orderRepo->find($orderId);

            $this->subtotal = $order->total;
            $this->grandtotal = $order->grand_total;
            $this->total = $order->grand_total;
            $this->tax = $order->tax;
            $this->payment_method = $order->payment_method;
            $this->payment_method_name = $order->payment_method_name;
            $this->additional_price = $order->additional_price;
            $this->has_additional_price = $order->has_additional_price;
            $this->order = $order;

            $this->dispatchBrowserEvent('open-payment');
        } catch (\Exception $e) {
            Log::error('Error opening payment: ' . $e->getMessage());
            $this->addError('open', 'Error opening payment. Silakan coba lagi.');
        }
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-payment');
    }

    /**
 * @OA\Post(
 *     path="/api/save-payment",
 *     summary="Menyimpan pembayaran pesanan",
 *     description="Validasi dan menyimpan data pembayaran pesanan ke dalam database.",
 *     tags={"Payment"},
 *     @OA\Parameter(
 *         name="order_id",
 *         in="query",
 *         description="ID pesanan",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="amount",
 *         in="query",
 *         description="Jumlah pembayaran",
 *         required=true,
 *         @OA\Schema(type="number", format="float", example=100.00)
 *     ),
 *     @OA\Parameter(
 *         name="payment_method",
 *         in="query",
 *         description="Metode pembayaran",
 *         required=true,
 *         @OA\Schema(type="string", example="credit_card")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pembayaran berhasil disimpan.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Pembayaran berhasil disimpan.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validasi gagal.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Data yang diberikan tidak valid."),
 *             @OA\Property(property="errors", type="object", example={"amount": {"The amount field is required."}})
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Kesalahan server.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Terjadi kesalahan saat menyimpan pembayaran.")
 *         )
 *     ),
 * )
 */

    public function save()
    {
        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Validasi data
            $data = $this->validate();

            // Perbarui pesanan dalam transaksi
            $this->order->update($data);

            // Commit transaksi jika semuanya berhasil
            DB::commit();

            // Emit acara reload dan tutup pembayaran
            $this->emit('reload', 'Pembayaran Behasil');
            $this->close();
            $this->dispatchBrowserEvent('paid', [
                'invoice' => $this->order->invoice
            ]);
        } catch (ValidationException $e) {
            // Validasi gagal, tangani exception dan tampilkan kesalahan
            $this->addError('validation', $e->validator->errors()->first());

            // Rollback transaksi
            DB::rollBack();
        } catch (\Exception $e) {
            // Tangani exception lain jika diperlukan
            \Log::error('Error saving payment: ' . $e->getMessage());
            $this->addError('save', 'Error saving payment. Silakan coba lagi.');

            // Rollback transaksi
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.admin.order.pay');
    }
}
