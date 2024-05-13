@extends('_layouts.admin.app')

@section('pretitle', 'Admin')

@section('title', 'Dashboard')

@section('content')

    <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Pesanan Aktif</div>
                    <div class="h1">{{ $orderActive }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Pesanan Pending</div>
                    <div class="h1">{{ $orderPending }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Pemasukan</div>
                        <div class="ms-auto lh-1">
                            <div class="dropdown">
                            @php
                                $type = request()->type
                            @endphp

                              <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $type === 'today' ? 'Hari ini' : ($type === 'month' ? 'Bulan ini' : ($type === 'week' ? 'Minggu ini' : ($type === 'all' ? 'Semua' : 'Hari ini'))) }}</a>
                              <form class="dropdown-menu dropdown-menu-end">
                                <button name="type" value="today" class="dropdown-item {{ $type === 'today' ? 'active' : '' }}" href="#">Hari Ini</button>
                                <button name="type" value="week" class="dropdown-item {{ $type === 'week' ? 'active' : '' }}" href="#">Minggu Ini</button>
                                <button name="type" value="month" class="dropdown-item {{ $type === 'month' ? 'active' : '' }}" href="#">Bulan Ini</button>
                                <button name="type" value="all" class="dropdown-item {{ $type === 'all' ? 'active' : '' }}" href="#">Semua</button>
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="h1">{{ number_format($orderIncome) }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Total Pelangan</div>
                    <div class="h1">{{ $userCount }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Grafik Pesanan</h3>
                <div id="order-graphic" class="chart-lg"></div>
              </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Grafik Pemasukan</h3>
                <div id="order-income" class="chart-lg"></div>
              </div>
            </div>
        </div>

    </div>

@endsection

@push('js')
    
    <script src="{{ asset('tabler-dev/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

    <script>
        const orderFinishedGraphic = JSON.parse('@json($orderFinishedGraphic)')
        const orderIncomeGraphic = JSON.parse('@json($orderIncomeGraphic)')
    </script>

    <script src="{{ asset('js/admin/dashboard.js') }}"></script>

@endpush