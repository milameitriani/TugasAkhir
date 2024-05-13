<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tampilan Meja</h3>
    </div>
    <div>
        <div class="card-body">
            <div class="row">
                @forelse ($tables as $table)
                    <div class="col-2 col-sm-4 col-md-3 col-lg-2 mb-2">
                        @if ($table->orders_count)
                            <a href="{{ route('admin.orders.detail', $table->orders[0]->invoice) }}" class="rounded bg-primary border border-primary text-white d-flex align-items-center text-center justify-content-center py-2 h3">
                                {{ $table->no }}       
                            </a>
                        @else
                            <div class="rounded bg-light border d-flex align-items-center text-center justify-content-center py-2 h3">
                                {{ $table->no }}       
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col">Kosong</div>
                @endforelse
            </div>
        </div>
        <div class="card-body">
            <div class="mb-1">
                <span class="badge bg-primary">Biru</span> : Isi
            </div>
            <span class="badge bg-light text-body">Putih</span> : Kosong
        </div>
    </div>
</div>