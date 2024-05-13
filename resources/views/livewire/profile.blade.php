@section('pretitle', 'Pengaturan')
@section('title', 'Edit Profil')

<div>
    
    <x-flash />

    <form class="card" wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title">Edit Profil</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Nama Pengguna</label>
                <div class="col">
                    <input type="text" class="form-control @error('user.username') is-invalid @enderror" placeholder="Nama Pengguna" wire:model.defer="user.username" autofocus>

                    @error('user.username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Nama</label>
                <div class="col">
                    <input type="text" class="form-control @error('user.name') is-invalid @enderror" placeholder="Nama" wire:model.defer="user.name">

                    @error('user.name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kata Sandi</label>
                <div class="col">
                    <div class="row gx-2">
                        <div class="col">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" wire:model.defer="password">

                            <small class="form-hint">Kosongkan jika tidak diubah</small>

                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" wire:model.defer="password_confirmation">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Simpan</button>
        </div>
    </form>

</div>
