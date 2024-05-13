<div class="modal fade" id="show" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if ($menu)
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <img src="{{ $menu->photo_src }}" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover; object-position: top;">
                        </div>
                        <div class="col-sm-6">
                            <dl>
                                <dt>Nama</dt>
                                <dd>{{ $menu->name }}</dd>
                                <dt>Jenis</dt>
                                <dd>{{ $menu->type_name }}</dd>
                                <dt>Kategori</dt>
                                <dd>{{ $menu->category ? $menu->category->name : '-' }}</dd>
                                <dt>Harga</dt>
                                <dd>Rp {{ $menu->price_formatted }}</dd>
                                <dt>Deskripsi</dt>
                                <dd>{{ $menu->description }}</dd>
                            </dl>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="module">
        const modal = new bootstrap.Modal(document.getElementById('show'))

        window.addEventListener('open-show', () => {
            modal.show()
        })

        window.addEventListener('close-show', () => {
            modal.hide()
        })
    </script>

@endpush