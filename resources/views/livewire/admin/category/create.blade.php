<div class="modal fade" id="create" wire:ignore.self>
    <div class="modal-dialog">
        <form class="modal-content" wire:submit.prevent="save">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" wire:model.defer="name">

                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kategori</label>
                    <select class="form-control @error('type') is-invalid @enderror" wire:model.defer="type">
                        <option value="food">Makanan</option>
                        <option value="drink">Minuman</option>
                    </select>

                    @error('type')
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
        const modal = new bootstrap.Modal(document.getElementById('create'))

        window.addEventListener('open-create', () => {
            modal.show()
        })

        window.addEventListener('close-create', () => {
            modal.hide()
        })
    </script>

@endpush