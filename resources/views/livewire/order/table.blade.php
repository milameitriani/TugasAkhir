@section('pretitle', 'Master')

@section('title', 'Data Pesanan Saya')

@section('button')

    <a class="btn btn-primary" href="{{ route('home') }}">Tambah Pesanan</a>

@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Data Pesanan Saya</h3>
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
                            <option value="pending">Pending</option>
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
                            <td wire:loading.class="text-muted">{{ $order->admin->name ?? '-' }}</td>
                            <td width="5%" class="text-end">        
                                <a href="{{ route('order.detail', $order->invoice) }}" wire:loading.attr="disabled" class="btn">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $orders->links() }}
        </div>
    </div>

</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.css') }}">
@endpush

@push('js')

    <script src="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.min.js') }}"></script>

    <script>
        const getTableUrl = '{{ route('ajax.tables.search', ['hasorder' => true]) }}'

        const setTable = val => @this.set('table', val)
        const removeTable = () => @this.set('table', null)
    </script>

    <script src="{{ asset('js/admin/order/index.js') }}"></script>

@endpush