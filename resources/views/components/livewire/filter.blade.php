<div class="d-flex">
    <div class="text-muted">
        Tampilkan
        <div class="mx-2 d-inline-block">
            <select class="form-control form-control-sm" wire:model="take">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option value="0">Semua</option>
            </select>
        </div>
        Baris
    </div>
    <div class="ms-auto text-muted d-flex align-items-end">
        <div>
            <div class="ms-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" placeholder="Cari" wire:model="search">
            </div>
        </div>
        {{ $filter ?? '' }}
    </div>
</div>