<div class="col-md-3">
    <h3 class="subheader mb-2">Cari</h3>
    <div class="pb-3 mb-3 border-bottom">
        <div class="input-icon">
            <input type="search" class="form-control" placeholder="Cari" wire:model="search">
            <span class="input-icon-addon">
              <!-- Download SVG icon from http://tabler-icons.io/i/search -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
            </span>
        </div>
    </div>

    <h3 class="subheader mb-2">Jenis Menu</h3>
    <div class="list-group list-group-transparent m-0 mb-3">
        <div class="list-group-item list-group-item-action d-flex align-items-center page-link {{ $type ? '' : 'active' }}" wire:click="resetFilterType">
            Semua
        </div>
        <div class="list-group-item list-group-item-action d-flex align-items-center pointer {{ $type == 'food' ? 'active' : '' }}" wire:click="filterByType('food')">
            Makanan
            <small class="text-muted ms-auto">{{ $countFood }}</small>
        </div>
        <div class="list-group-item list-group-item-action d-flex align-items-center pointer {{ $type == 'drink' ? 'active' : '' }}" wire:click="filterByType('drink')">
            Minuman
            <small class="text-muted ms-auto">{{ $countDrink }}</small>
        </div>
    </div>

    <h3 class="subheader mb-2">Kategori</h3>
    <div class="list-group list-group-transparent m-0 mb-3">
        <div class="list-group-item list-group-item-action d-flex align-items-center page-link {{ $category ? '' : 'active' }}" wire:click="resetFilterCategory">
            Semua
        </div>
        @foreach ($categories as $item)
            <div class="list-group-item list-group-item-action d-flex align-items-center pointer {{ $category == $item->id ? 'active' : '' }}" wire:click="filterByCategory({{ $item->id }}, '{{ $item->type }}')">
                {{ $item->name }}
                <small class="text-muted ms-auto">{{ $item->menus_count }}</small>
            </div>
        @endforeach
    </div>
</div>
