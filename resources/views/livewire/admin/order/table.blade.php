@section('pretitle', 'Master')

@section('title', 'Data Pesanan')

@section('button')

    @can('admin')
    <a class="btn btn-primary" href="{{ route('admin.orders.create') }}">Tambah Pesanan</a>
    @endcan
    @can('pelayanan')
    <a class="btn btn-primary" href="{{ route('admin.orders.create') }}">Tambah Pesanan</a>
    @endcan
    @can('admin')
    <a class="btn btn-warning" href="{{ route('admin.tables') }}">Tampilan Meja</a>
    @endcan
    @can('pelayanan')
    <a class="btn btn-warning" href="{{ route('admin.tables') }}">Tampilan Meja</a>
    @endcan
@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Data Pesanan</h3>
            <div>
                <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#filter">Filter</button>
                <button class="btn btn-danger" wire:click="resetFilter">Reset Filter</button>
            </div>
        </div>
        <div class="collapse" id="filter" wire:ignore.self>
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="mb-3 col">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" placeholder="No Meja" wire:model="date">
                    </div>
                    <div class="mb-3 col form-group">
                        <label class="form-label">No. Meja</label>
                        <div wire:ignore>
                            <input type="text" class="form-control custom-tagify" placeholder="No. Meja" name="table_id">
                        </div>
                    </div>
                    <div class="mb-3 col">
                        <label class="form-label">Status</label>
                        <select class="form-control" wire:model="status">
                            <option value="" selected>Semua</option>
                            @canany(['admin', 'pelayanan'])
                            <option value="pending">Pending</option>
                            @endcan
                            <option value="active">Aktif</option>
                            <option value="finish">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label class="form-label">Status Makanan</label>
                        <select class="form-control" wire:model="cooking">
                            <option value="" selected>Semua</option>
                            <option value="0">Sedang Dimasak</option>
                            <option value="1">Sudah Jadi</option>
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label class="form-label">Status Minuman</label>
                        <select class="form-control" wire:model="drink">
                            <option value="" selected>Semua</option>
                            <option value="0">Sedang Diproses</option>
                            <option value="1">Sudah Jadi</option>
                        </select>
                    </div>
                    <div class="mb-3 col">
                        <label class="form-label">Status Pembayaran</label>
                        <select class="form-control" wire:model="payment">
                            <option value="" selected>Semua</option>
                            <option value="0">Belum Bayar</option>
                            <option value="1">Sudah Bayar</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom">
            <x-livewire.filter />
        </div>
        <div class="table-responsive-lg">
            <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Meja</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Status Makanan</th>
                        <th>Status Minuman</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                        <th>Pelanggan</th>
                        <th colspan="2">Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="text-muted">{{ $order->invoice }}</td>
                            <td wire:loading.class="text-muted"><span class="badge bg-dark">{{ $order->table->no ?? '-' }}</span></td>
                            <td wire:loading.class="text-muted">{{ $order->date }}</td>
                            <td wire:loading.class="text-muted">{!! $order->status_badge !!}</td>
                            <td wire:loading.class="text-muted">{!! $order->cooking_badge !!}</td>
                            <td wire:loading.class="text-muted">{!! $order->drink_badge !!}</td>
                            <td wire:loading.class="text-muted">{!! $order->payment_badge !!}</td>
                            <td wire:loading.class="text-muted">Rp {{ $order->total_formatted }}</td>
                            <td wire:loading.class="text-muted">{{ $order->user->name ?? 'Umum' }}</td>
                            <td wire:loading.class="text-muted">{{ $order->admin->name ?? '-' }}</td>
                            <td width="5%" class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Aksi</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @if ($order->status === 'pending')
                                            <button wire:loading.attr="disabled" wire:click="confirm({{ $order->id }})" class="dropdown-item">Konfirmasi</button>
                                        @else
                                            @can('kasir')
                                            @if (!$order->payment_status)
                                                <button wire:loading.attr="disabled" wire:click="$emit('pay', {{ $order->id }})" class="dropdown-item">Bayar</button>
                                            @endif
                                            @endcan
                                            @can('admin')
                                            @if (!$order->payment_status)
                                                <button wire:loading.attr="disabled" wire:click="$emit('pay', {{ $order->id }})" class="dropdown-item">Bayar</button>
                                            @endif
                                            @endcan
                                            @can('koki')
                                            @if (!$order->cooking_status)
                                                <button wire:loading.attr="disabled" wire:click="finishCook({{ $order->id }})" class="dropdown-item">Makanan Sudah Jadi</button>
                                            @endif
                                            @endcan
                                            @can('bar')
                                            @if (!$order->drink_status)
                                                <button wire:loading.attr="disabled" wire:click="finishDrink({{ $order->id }})" class="dropdown-item">Minuman Sudah Jadi</button>
                                            @endif
                                            @endcan
                                            @if ($order->payment_status && $order->status === 'active')
                                                <button wire:loading.attr="disabled" wire:click="finish({{ $order->id }})" class="dropdown-item">Selesai</button>
                                            @endif
                                        @endif
                                        <a href="{{ route('admin.orders.detail', $order->invoice) }}" wire:loading.attr="disabled" class="dropdown-item">Detail</a>
                                        <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $order->id }})" class="dropdown-item">Hapus</button>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $orders->links() }}
        </div>
    </div>

    <livewire:admin.order.confirm />
    <livewire:admin.order.pay />
    <livewire:admin.order.delete />

</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.css') }}">
@endpush

@push('js')

    <script src="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.min.js') }}"></script>

    <script>
        const getTableUrl = '{{ route('ajax.tables.search', ['hasorder' => true]) }}'
        const printOrderPerTypeUrl = '{{ route('admin.orders.print-per-type', ['invoice' => ':invoice']) }}'

        const setTable = val => @this.set('table', val)
        const removeTable = () => @this.set('table', null)
    </script>

    <script src="{{ asset('js/admin/order/index.js') }}"></script>

@endpush