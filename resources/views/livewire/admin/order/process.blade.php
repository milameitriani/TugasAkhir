@section('pretitle', 'Order')
@section('title', 'Proses Order')

@section('button')

    <a href="{{ route('admin.orders.create') }}" class="btn btn-light">Kembali</a>

@endsection

<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Order</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Jenis Order</label>
                    <select class="form-control @error('type') is-invalid @enderror" wire:model="type">
                        <option value="dine-in">Makan disini</option>
                    </select>

                    @error('type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-group {{ $type === 'take-away' ? 'd-none' : '' }} @error('table_id') is-invalid @enderror">
                    <label class="form-label">No. Meja</label>
                    <div wire:ignore>
                        <input type="text" class="form-control custom-tagify" placeholder="No. Meja" name="table_id">
                    </div>

                    @error('table_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="@if (!$table_id) d-none @endif mb-3 form-group @error('user_id') is-invalid @enderror">
                    <label class="form-label">Pelanggan</label>
                    <div wire:ignore>
                        <input type="text" class="form-control custom-tagify" placeholder="Pelanggan" name="user_id">
                    </div>

                    @error('user_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select class="form-control @error('payment_method') is-invalid @enderror" wire:model="payment_method">
                        <option value="cash" selected>Cash</option>
                        <option value="qris" selected>QRIS</option>
                        <option value="bca" selected>BCA CARD</option>
                    </select>

                    @error('payment_method')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    @if ($type === 'dine-in')
                        <button class="btn btn-primary me-2" wire:click="save" wire:loading.attr="disabled" wire:target="save">Order</button>
                    @endif
                    @cannot('pelayanan')
                    <button class="btn btn-success" wire:click="payment" wire:loading.attr="disabled" wire:target="payment">{{ $type === 'dine-in' ? 'Langsung Bayar' : 'Bayar' }}</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th colspan="2">Subtotal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($menus as $item)
                        @php
                            $menu = $item['menu'];
                            $subtotal = $item['qty'] * $menu['price'];
                        @endphp
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>
                                <td wire:loading.class="text-muted">
                                    <div class="d-flex align-items-center py-1">
                                        <span class="avatar me-2" style="background-image: url({{ local($menu['photo'], 'menus') }});"></span>
                                        <div class="flex-fill">
                                            {{ $menu['name'] }}
                                            <small class="text-muted d-block">{{ number_format($menu['price']) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td wire:loading.class="text-muted">{{ $item['qty'] }}</td>
                                <td wire:loading.class="text-muted">{{ number_format($subtotal) }}</td>
                                <td width="20%" class="text-end">
                                    <button wire:loading.attr="disabled" wire:click="remove({{ $menu['id'] }})" class="btn btn-white">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-end" colspan="3"><b>Total</b></td>
                            <td class="text-end">Rp {{ number_format($total) }}</td>
                            <td class="text-end"></td>
                        </tr>
                        <tr>
                            <td class="text-end" colspan="3"><b>Tax and Service (15%)</b></td>
                            <td class="text-end">Rp {{ number_format($tax) }}</td>
                            <td class="text-end"></td>
                        </tr>
                        @if ($hasAdditionalPrice)
                        <tr>
                            <td class="text-end" colspan="3"><b>BCA CARD (1%)</b></td>
                            <td class="text-end">Rp {{ number_format($additional_price) }}</td>
                            <td class="text-end"></td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-end" colspan="3"><b>Grand Total</b></td>
                            <td class="text-end">Rp {{ number_format($grand_total) }}</td>
                            <td class="text-end"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <livewire:admin.order.payment />

</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.css') }}">
@endpush

@push('js')

    <script src="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.min.js') }}"></script>

    <script>
        const getTableUrl = '{{ route('ajax.tables.search', ['all' => true]) }}'
        const getUserUrl = '{{ route('ajax.users.search') }}'
        const printUrl = '{{ route('admin.orders.print', ['invoice' => ':invoice']) }}'
        const printUpdateUrl = '{{ route('admin.orders.print-update', ['invoice' => ':invoice']) }}'
        const detailUrl = '{{ route('admin.orders.detail', ['invoice' => ':invoice']) }}'

        const setTable = val => @this.set('table_id', val)
        const setUser = val => @this.set('user_id', val)
        const removeTable = () => @this.set('table_id', null)
        const removeUser = () => @this.set('user_id', null)
    </script>

    <script src="{{ asset('js/admin/order/process.js') }}"></script>

@endpush