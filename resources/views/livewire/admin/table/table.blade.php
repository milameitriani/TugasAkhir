@section('pretitle', 'Master')

@section('title', 'Meja')

@section('button')

    <button class="btn btn-primary" id="create-btn">Tambah Data</button>

@endsection

<div class="row">

    <div class="col-sm-4 mb-3">
        <livewire:admin.table.box />
    </div>
    <div class="col-sm-8">
        <x-flash />

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Data Meja</h3>
            </div>
            <div class="collapse show">
                <div class="card-body border-bottom">
                    <x-livewire.filter />
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                        <thead>
                            <tr>
                                <th width="15%">No</th>
                                <th>No Meja</th>
                                <th colspan="2">Isi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tables as $table)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td wire:loading.class="text-muted">{{ $table->no }}</td>
                                    <td wire:loading.class="text-muted"><span class="badge bg-{{ $table->orders_count ? 'warning' : 'success' }}">{{ $table->orders_count ? 'isi' : 'kosong' }}</span></td>
                                    <td width="20%" class="text-end">
                                        <button wire:loading.attr="disabled" wire:click="$emit('edit', {{ $table->id }})" class="btn btn-white">Edit</button>
                                        <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $table->id }})" class="btn btn-white">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" align="center">Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $tables->links() }}
                </div>
            </div>
        </div>
    </div>


    <livewire:admin.table.create />
    
    <livewire:admin.table.edit />

    <livewire:admin.table.delete />

</div>

@push('js')

    <script>
        document.getElementById('create-btn').onclick = () => Livewire.emit('create')
    </script>

@endpush