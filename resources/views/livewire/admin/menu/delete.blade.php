<div class="modal modal-blur fade" id="delete">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Hapus</div>
                <div>Hapus menu ini?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" wire:click="delete">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="module">
        const modal = new bootstrap.Modal(document.getElementById('delete'))

        window.addEventListener('open-delete', () => {
            modal.show()
        })

        window.addEventListener('close-delete', () => {
            modal.hide()
        })
    </script>

@endpush