@section('pretitle', 'Petunjuk')
@section('title', 'Edit Petunjuk')

<div>
    
    <x-flash />

    <form class="card" wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title">Edit Petunjuk</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Petunjuk Penggunaan</label>
                <div class="col">
                    <textarea rows="6" class="form-control @error('help.content') is-invalid @enderror" placeholder="Petunjuk Penggunaan" wire:model.defer="help.content" @cannot('admin')
                        disabled 
                    @endcannot></textarea>

                    @error('help.content')
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
