<div class="modal fade" id="payment" wire:ignore.self>
    <div class="modal-dialog">
        <form class="modal-content" wire:submit.prevent="save">
            <div class="modal-header">
                <h5 class="modal-title">Bayar Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if (isset($order->menus))
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="font-weight-bold m-0">Pelanggan</p>
                                <address>
                                    {{ $order->user->name ?? 'Umum' }} <br>
                                </address>
                            </div>
                            <div class="col-sm-6">
                                <p class="font-weight-bold m-0">No Meja</p>
                                <address>
                                    {{ $order->table->no ?? '-' }} <br>
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Harga(Rp)</th>
                                        <th>Subtotal(Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->menus as $menu)
                                        <tr>
                                            <td class="text-muted">{{ $loop->iteration }}</td>
                                            <td wire:loading.class="text-muted">{{ $menu->name }}</td>
                                            <td wire:loading.class="text-muted">{{ $menu->pivot->quantity }}</td>
                                            <td wire:loading.class="text-muted">{{ $menu->price_formatted }}</td>
                                            <td wire:loading.class="text-muted" align="right" width="15%">{{ number_format($menu->pivot->quantity * $menu->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Total</label>
                                <input type="text" class="form-control" placeholder="Total" value="{{ number_format($subtotal) }}" disabled>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Tax dan Service (15%)</label>
                                <input type="text" class="form-control" placeholder="Tax dan Service (15%)" value="{{ number_format($tax) }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 @if ($has_additional_price) col-sm-6 @else col-sm-12 @endif">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-control @error('payment_method') is-invalid @enderror" wire:model="payment_method">
                                    <option value="cash" selected>Cash</option>
                                    <option value="qris" selected>QRIS</option>
                                    <option value="bca" selected>BCA CARD</option>
                                </select>
                            </div>
                            @if ($has_additional_price)
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">BCA CARD (1%)</label>
                                <input type="text" class="form-control" placeholder="BCA CARD (1%)" value="{{ number_format($additional_price) }}" disabled>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Grand Total</label>
                            <input type="text" class="form-control" placeholder="Grand Total" value="{{ number_format($total) }}" disabled>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Jumlah Bayar</label>
                                <input type="text" class="form-control @error('paid') is-invalid @enderror" placeholder="Jumlah Bayar" wire:model="paidVal">

                                @error('paid')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Kembali</label>
                                <input type="text" class="form-control" placeholder="Kembali" value="{{ number_format($fine) }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" wire:model="toggle">
                                <span class="form-check-label">Selesai</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('js')

    <script>
        const printUrl = '{{ route('admin.orders.print', ['invoice' => ':invoice']) }}'
    </script>

    <script type="module">
        const modal = new bootstrap.Modal(document.getElementById('payment'))

        window.addEventListener('open-payment', () => {
            modal.show()
        })

        window.addEventListener('close-payment', () => {
            modal.hide()
        })

        window.addEventListener('paid', (e) => {
            const invoice = e.detail.invoice
            const url = printUrl.replace(':invoice', invoice)

            window.open(url, '_blank')
        })
    </script>

@endpush