<div class="modal fade" id="payment" wire:ignore.self>
    <div class="modal-dialog">
        <form class="modal-content" wire:submit.prevent="save">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
                        <input type="text" class="form-control" placeholder="Metode Pembayaran" value="{{ $payment_method_name }}" disabled>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('js')

    <script type="module">
        const modal = new bootstrap.Modal(document.getElementById('payment'))

        window.addEventListener('open-payment', () => {
            modal.show()
        })

        window.addEventListener('close-payment', () => {
            modal.hide()
        })
    </script>

@endpush