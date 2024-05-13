<div class="modal fade" id="create" wire:ignore.self>
    <div class="modal-dialog">
        <form class="modal-content" wire:submit.prevent="save">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" wire:model.defer="name">

                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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