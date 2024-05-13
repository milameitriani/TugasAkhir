@section('pretitle', 'Master')

@section('title', 'Pelanggan / Pengguna')

@section('button')

    <button class="btn btn-primary" id="create-btn">Tambah Data</button>

@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header border-bottom d-flex align-items-center justify-content-between">
            <h3 class="card-title">Data Pelanggan/Pengguna</h3>
        </div>
        <div class="card-body border-bottom">
            <x-livewire.filter />
        </div>
        <div class="table-responsive-md">
            <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th colspan="2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td wire:loading.class="text-muted">{{ $user->name }}</td>
                            <td width="5%" class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Aksi</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <button wire:loading.attr="disabled" wire:click="$emit('edit', {{ $user->id }})" class="dropdown-item">Edit</button>
                                        <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $user->id }})" class="dropdown-item">Hapus</button>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $users->links() }}
        </div>
    </div>

    <livewire:admin.user.create />
    
    <livewire:admin.user.edit />

    <livewire:admin.user.delete />

</div>

@push('js')

    <script>
        document.getElementById('create-btn').onclick = () => Livewire.emit('create')
    </script>

@endpush