<div class="modal fade" id="edit" wire:ignore.self>
    <div class="modal-dialog">
        <form class="modal-content" wire:submit.prevent="save">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control @error('admin.name') is-invalid @enderror" placeholder="Nama" wire:model.defer="admin.name">

                            @error('admin.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control @error('admin.username') is-invalid @enderror" placeholder="Nama Pengguna" wire:model.defer="admin.username">

                            @error('admin.username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">
                                Kata Sandi
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" wire:model.defer="password">

                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" wire:model.defer="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-control @error('admin.role') is-invalid @enderror" wire:model.defer="admin.role">
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="pelayanan">Pelayanan</option>
                        <option value="koki">Koki</option>
                        <option value="bar">Bar</option>
                    </select>

                    @error('admin.role')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telp</label>
                    <input type="number" class="form-control @error('admin.phone') is-invalid @enderror" placeholder="No. Telp" wire:model.defer="admin.phone">

                    @error('admin.phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control @error('admin.address') is-invalid @enderror" placeholder="Alamat" wire:model.defer="admin.address"></textarea>

                    @error('admin.address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('js')

    <script type="module">
        const modal = new bootstrap.Modal(document.getElementById('edit'))

        window.addEventListener('open-edit', () => {
            modal.show()
        })

        window.addEventListener('close-edit', () => {
            modal.hide()
        })
    </script>

@endpush