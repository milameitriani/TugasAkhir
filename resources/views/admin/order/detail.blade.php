@extends('_layouts.admin.app')

@section('pretitle', 'Order')

@section('title', 'Detail Pesanan')

@section('button')
    <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Kembali</a>
    <button class="btn btn-primary" onclick="javascript:window.print()">
        <!-- Download SVG icon from http://tabler-icons.io/i/file-invoice -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
        Cetak
    </button>
    <a href="{{ route('admin.orders.print', $order->invoice) }}" target="_blank" class="btn btn-success">
        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
        Cetak Struk
    </a>
@endsection

@section('content')

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
                        <strong>Petugas</strong> : {{ $order->admin->name ?? 'Umum' }} <br>
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
                            $isBarOrKoki = auth()->user()->canany(['bar', 'koki']);
                            $isBar = auth()->user()->can('bar');
                            $isKoki = auth()->user()->can('koki');
                        @endphp

                        @if (!$isBarOrKoki || ($isBar && $menu->type === 'drink') || ($isKoki && $menu->type === 'food'))
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
                        @endif
                    @endforeach

                    @canany(['bar', 'koki'])

                    <tr>
                        <td colspan="4" align="right">
                            <strong>Subtotal</strong>
                        </td>
                        <td align="right">{{ number_format($total) }}</td>
                    </tr>

                    @endcan
                    
                    @canany(['admin', 'pelayanan', 'kasir'])
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
                    @endcan
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