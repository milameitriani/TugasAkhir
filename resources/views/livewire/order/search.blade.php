<div class="col-md-9">
    <div class="row">
        @forelse ($menus as $menu)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card card-sm h-100">
                    <img src="{{ $menu->photo_src }}" class="card-img-top" style="width: 100%; height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title mb-2 pointer" wire:click="$emit('show', {{ $menu->id }})">{{ $menu->name }}</h4>
                        <span class="badge {{ $menu->type === 'food' ? 'bg-warning' : 'bg-info' }}">{{ $menu->type_name }}</span>

                        @if ($menu->category)
                            <span class="badge {{ $menu->type === 'food' ? 'bg-warning' : 'bg-info' }}">{{ $menu->category ? $menu->category->name : '-' }}</span>
                        @endif

                        <p class="mt-2 lead">Rp {{ $menu->price_formatted }}</p>
                        <p class="mt-2 lead">{{ $menu->description }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" wire:click="store({{ $menu }})" wire:loading.attr="disabled" wire:target="store">
                            <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart-plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l6.005 .429m7.138 6.573l-.143 .998h-13" /><path d="M15 6h6m-3 -3v6" /></svg>
                            Tambah ke pesanan
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-warning">Tidak ada menu</div>
            </div>
        @endforelse
    </div>

    @if (count($menus))
        <div class="d-flex align-items-center justify-content-between">
            {{ $menus->links() }}
        </div>
    @endif
</div>
