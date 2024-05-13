@section('pretitle', 'Master')

@section('title', 'Petugas')

@section('button')

    <button class="btn btn-primary" id="create-btn">Tambah Data</button>

@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Petugas</h3>
        </div>
        <div class="card-body border-bottom">
            <x-livewire.filter />
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Pengguna</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        <th colspan="2">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td wire:loading.class="text-muted">{{ $admin->name }}</td>
                            <td wire:loading.class="text-muted">{{ $admin->username }}</td>
                            <td wire:loading.class="text-muted">{{ $admin->phone ?? '-' }}</td>
                            <td wire:loading.class="text-muted">{{ $admin->address ?? '-' }}</td>
                            <td wire:loading.class="text-muted">{!! $admin->role_badge !!}</td>
                            <td width="5%" class="text-end">
                                <button wire:loading.attr="disabled" wire:click="$emit('edit', {{ $admin->id }})" class="btn btn-white" {{ user('id') === $admin->id ? 'disabled' : '' }}>Edit</button>
                                <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $admin->id }})" class="btn btn-white" {{ user('id') === $admin->id ? 'disabled' : '' }}>Hapus</button>
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
            {{ $admins->links() }}
        </div>
    </div>

    <livewire:admin.admin.create />
    
    <livewire:admin.admin.edit />

    <livewire:admin.admin.delete />

</div>

@push('js')

    <script>
        document.getElementById('create-btn').onclick = () => Livewire.emit('create')
    </script>

@endpush