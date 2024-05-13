<style>
    body {
        font-size: 14px;
    }

    table {
        border-collapse: collapse;
    }
    table td {
        padding: 0;
    }

    .title {
        font-size: 1.5rem;
        font-weight: bold;
        padding-bottom: 20px;
    }
    .subtitle {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .data {
        margin-bottom: 2rem;
    }

    .data th, .data td {
        border: 1px solid #111;
        padding: 5px;
    }
    .data th {
        text-align: left;
    }
</style>

<table class="header" width="100%">
    <tr valign="middle">
        <td>
            <p class="title">{{ config('setting.name') }}</p>
            <p>{{ config('setting.address') }}</p>
            <p>{{ config('setting.phone') }}</p>
        </td>
        <td align="right">
            <p class="subtitle">{{ $title }}</p>
            <time>{{ $date }}</time>
        </td>
    </tr>
</table>

<hr>

{{-- <table width="100%" class="data">
    <thead>
        <tr>
            <th>No. Transaksi</th>
            <th>Tanggal</th>
            <th>No. Meja</th>
            <th>Tipe Pesanan</th>
            <th>Pelanggan</th>
            <th>Petugas</th>
            <th>Total(Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
            $tax = 0;
            $additional_price = 0;
        @endphp

        @forelse ($orders as $order)
        @php
            $total += $order->total;
        @endphp

            <tr>
                <td>{{ $order->invoice }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ $order->table->no ?? '-' }}</td>
                <td>{{ $order->type_text }}</td>
                <td>{{ $order->user->name ?? 'Umum' }}</td>
                <td>{{ $order->admin->name ?? '-' }}</td>
                <td align="right">{{ $order->total_formatted }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" align="center">Kosong</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" align="right">Total</td>
            <td align="right">{{ number_format($total) }}</td>
        </tr>
    </tfoot>
</table> --}}

<table width="100%" class="data">
    <thead>
        <tr>
            <th>No. Transaksi</th>
            <th>Tanggal</th>
            <th>No. Meja</th>
            <th>Pelanggan</th>
            <th>Petugas</th>
            <th align="right">Cash</th>
            <th align="right">Kartu/Debit</th>
            <th align="right">QRIS</th>
            <th align="right">Tax and Service</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalCash = 0;
            $totalQris = 0;
            $totalBca = 0;
            $totalTaxAndService = 0;
        @endphp

        @forelse ($orders as $order)
        @php
            $totalCash += $order->payment_method === 'cash' ? $order->paid : 0;
            $totalQris += $order->payment_method === 'qris' ? $order->paid : 0;
            $totalBca += $order->payment_method === 'bca' ? $order->paid : 0;
            $totalTaxAndService += $order->tax + $order->additional_price;
        @endphp

            <tr>
                <td>{{ $order->invoice }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ $order->table->no ?? '-' }}</td>
                <td>{{ $order->user->name ?? 'Umum' }}</td>
                <td>{{ $order->admin->name ?? '-' }}</td>
                <td align="right">{{ $order->payment_method === 'cash' ? $order->paid_formatted : '-' }}</td>
                <td align="right">{{ $order->payment_method === 'qris' ? $order->paid_formatted : '-' }}</td>
                <td align="right">{{ $order->payment_method === 'bca' ? $order->paid_formatted : '-' }}</td>
                <td align="right">{{ number_format($order->tax + $order->additional_price) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9" align="center">Kosong</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" align="right">Total</td>
            <td align="right">{{ number_format($totalCash) }}</td>
            <td align="right">{{ number_format($totalQris) }}</td>
            <td align="right">{{ number_format($totalBca) }}</td>
            <td align="right">{{ number_format($totalTaxAndService) }}</td>
        </tr>
    </tfoot>
</table>