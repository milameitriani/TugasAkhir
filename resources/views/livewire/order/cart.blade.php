@section('title', 'Order Baru')

<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <div class="page-pretitle">
              Order
            </div>
            <h2 class="page-title">
              Order Baru
            </h2>
          </div>
          <div class="col-auto ms-auto">
            <div class="btn-list"> 
              <div class="dropdown">
                  <button class="btn btn-light position-relative dropdown-toggle" id="cart" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                      <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                      Pesanan
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-red">
                          {{ count($menus) }}
                      </span>
                  </button>

                  <ul class="dropdown-menu dropdown-menu-lg-end" style="width: 300px;">
                    @php
                        $total = 0
                    @endphp

                      @forelse ($menus as $item)
                        @php
                            $menu = $item['menu'];
                            $subtotal = $menu['price'] * $item['qty'];
                            $total += $subtotal 
                        @endphp

                          <li class="dropdown-item d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                              <img src="{{ local($menu['photo'], 'menus') }}" class="avatar avatar-sm me-2">
                              <div class="">
                                  <span>{{ $menu['name'] }} x {{ $item['qty'] }}</span>
                                  <small class="text-muted d-block">{{ number_format($subtotal) }}</small>
                              </div>
                            </div>
                            <div>
                              <button type="button" class="btn btn-sm btn-icon" wire:click="increment({{ $menu['id'] }})">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                              </button>
                              <button type="button" class="btn btn-sm btn-icon" wire:click="decrement({{ $menu['id'] }})">
                                <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
                              </button>
                              <button type="button" class="btn btn-sm btn-danger btn-icon" wire:click="remove({{ $menu['id'] }})">
                                <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                              </button>
                            </div>
                          </li>
                      @empty
                          <li class="dropdown-item text-muted">Kosong</li>
                      @endforelse

                      @if (count($menus))
                        <hr class="dropdown-divider">

                        <li class="dropdown-item d-flex align-items-center justify-content-between">
                            <span>Total</span>
                            Rp {{ number_format($total) }}
                        </li>

                        <li class="dropdown-item">
                            <button class="w-100 btn btn-primary" wire:click="process" wire:target="process" wire:loading.attr="disabled">Proses</button>
                        </li>
                      @endif
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row">

            <livewire:order.filter />

            <livewire:order.search />

            <livewire:order.show />

        </div>
      </div>
    </div>


</div>

@push('js')
<script src="{{ asset('js/cart.js') }}"></script>
@endpush