@section('pretitle', 'Master')

@section('title', 'Kategori Menu')

@section('button')

    <button class="btn btn-primary" id="create-btn">Tambah Data</button>

@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Kategori</h3>
        </div>
        <div class="card-body border-bottom">
            <x-livewire.filter>
                <x-slot name="filter">
                    <select class="ms-2 form-control form-control-sm" wire:model="type">
                        <option value="">Pilih Jenis Menu</option>
                        <option value="food">Makanan</option>
                        <option value="drink">Minuman</option>
                    </select>
                </x-slot>
            </x-livewire.filter>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th colspan="2">Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td wire:loading.class="text-muted">{{ $category->name }}</td>
                            <td wire:loading.class="text-muted">{{ $category->type_name }}</td>
                            <td width="20%" class="text-end">
                                <button wire:loading.attr="disabled" wire:click="$emit('edit', {{ $category->id }})" class="btn btn-white">Edit</button>
                                <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $category->id }})" class="btn btn-white">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $categories->links() }}
        </div>
    </div>

    <livewire:admin.category.create />
    
    <livewire:admin.category.edit />

    <livewire:admin.category.delete />

</div>

@push('js')

    <script>
        document.getElementById('create-btn').onclick = () => Livewire.emit('create')
    </script>

@endpush