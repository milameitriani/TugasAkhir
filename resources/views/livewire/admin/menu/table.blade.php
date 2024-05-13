@section('pretitle', 'Master')

@section('title', 'Menu')

@section('button')

    <a class="btn btn-primary" href="{{ route('admin.menus.create') }}">Tambah Data</a>

@endsection

<div>

    <x-flash />

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Data Menu</h3>
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
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th colspan="2">Harga (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td wire:loading.class="text-muted">
                                <div class="d-flex align-items-center py-1">
                                    <span class="avatar me-2" style="background-image: url({{ $menu->photo_src }});"></span>
                                    <div class="flex-fill">
                                        {{ $menu->name }}
                                    </div>
                                </div>
                            </td>
                            <td wire:loading.class="text-muted">{{ $menu->type_name }}</td>
                            <td wire:loading.class="text-muted">{{ $menu->category ? $menu->category->name : '-' }}</td>
                            <td wire:loading.class="text-muted">{{ $menu->price_formatted }}</td>
                            <td width="20%" class="text-end">
                                <button wire:loading.attr="disabled" wire:click="$emit('show', {{ $menu->id }})" class="btn btn-white">Lihat</button>
                                <a wire:loading.attr="disabled" href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-white">Edit</a>
                                <button wire:loading.attr="disabled" wire:click="$emit('delete', {{ $menu->id }})" class="btn btn-white">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $menus->links() }}
        </div>
    </div>
    
    <livewire:admin.menu.delete />

    <livewire:admin.menu.show />

</div>