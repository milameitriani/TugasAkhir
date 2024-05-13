@section('pretitle', 'Pengaturan')
@section('title', 'Edit Pengaturan')

<div>
    
    <x-flash />

    <form class="card" wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title">Edit Pengaturan</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Nama Restoran</label>
                <div class="col">
                    <input type="text" class="form-control @error('setting.name') is-invalid @enderror" placeholder="Nama Restoran" wire:model.defer="setting.name" autofocus @cannot('admin')
                        disabled 
                    @endcannot>

                    @error('setting.name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">No. Telp</label>
                <div class="col">
                    <input type="number" class="form-control @error('setting.phone') is-invalid @enderror" placeholder="No. Telp" wire:model.defer="setting.phone" @cannot('admin')
                        disabled 
                    @endcannot>

                    @error('setting.phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Alamat</label>
                <div class="col">
                    <textarea class="form-control @error('setting.address') is-invalid @enderror" placeholder="Alamat" wire:model.defer="setting.address" @cannot('admin')
                        disabled 
                    @endcannot></textarea>

                    @error('setting.address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        @can('admin')
            <div class="card-footer">
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Simpan</button>
            </div>
        @endcan
    </form>

</div>
