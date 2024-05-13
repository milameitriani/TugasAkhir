@extends('_layouts.app')

@section('pretitle', 'Order')

@section('title', 'Detail Pesanan')

@section('button')
    <a href="{{ route('order.index') }}" class="btn btn-light">Kembali</a>
@endsection

@section('content')

    @if ($order->status === 'pending')
        <div class="alert alert-warning">
            Silakan hubungi petugas untuk konfirmasi pesanan anda
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Invoice</h3>
            <time>{{ $order->date }}</time>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <p class="h3">{{ config('setting.name') }}</p>
                    <address>
                        {{ config('setting.address' )}} <br>
                        {{ config('setting.phone' )}}
                    </address>
                </div>
                <div class="col-sm-4">
                    <p class="h3">Pelanggan</p>
                    <address>
                        {{ $order->user->name ?? 'Umum' }} <br>
                    </address>
                </div>
                <div class="col-sm-4">
                    <p class="h3">Data Order</p>
                    <address>
                        <strong>No Transaksi</strong> : {{ $order->invoice }} <br>
                        <strong>Petugas</strong> : {{ $order->admin->name ?? '-' }} <br>
                    </address>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom status">
            <strong>Status</strong> : {!! $order->status_badge !!} <br>
            <strong>Status Pembayaran</strong> : {!! $order->payment_badge !!} <br>
            <strong>Jenis Pesanan</strong> : {!! $order->type_badge !!} <br>
            <strong>Metode Pembayaran</strong> : {{ $order->payment_method_name }} <br>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Qty</th>
                        <th>Harga(Rp)</th>
                        <th>Subtotal(Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0
                    @endphp

                    @foreach ($order->menus as $menu)
                        @php
                            $subtotal = $menu->pivot->quantity * $menu->price;
                            $total += $subtotal
                        @endphp

                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td wire:loading.class="text-muted">{{ $menu->name }}</td>
                            <td wire:loading.class="text-muted">{{ $menu->pivot->quantity }}</td>
                            <td wire:loading.class="text-muted">{{ $menu->price_formatted }}</td>
                            <td wire:loading.class="text-muted" align="right" width="15%">{{ number_format($subtotal) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Subtotal</strong>
                        </td>
                        <td align="right">{{ number_format($order->total) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Tax and Service (15%)</strong>
                        </td>
                        <td align="right">{{ number_format($order->tax) }}</td>
                    </tr>
                    @if ($order->has_additional_price)
                    <tr>
                        <td colspan="4" align="right">
                            <strong>BCA CARD (1%)</strong>
                        </td>
                        <td align="right">{{ number_format($order->additional_price) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Total</strong>
                        </td>
                        <td align="right">{{ number_format($order->grand_total) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Grand Total</strong>
                        </td>
                        <td align="right">{{ number_format($order->grand_total - $order->discount) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Terbayar</strong>
                        </td>
                        <td align="right">{{ $order->paid ? number_format($order->paid) : 0 }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">
                            <strong>Kembali</strong>
                        </td>
                        <td align="right">{{ $order->fine }}</td>
                    </tr>
                </tbody>
            </table>
    </div>

@endsection

@push('css')
    <style>
        @media print {
            .status {
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush