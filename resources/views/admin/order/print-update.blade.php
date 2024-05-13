<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 58mm;
            height: 38mm;
            font-size: 12px;
        }

        header {
            text-align: center;
        }
        header p {
            margin: 0;
            margin-bottom: 5px;
            padding: 0;
        }
        header .title {
            font-weight: bold;
            font-size: larger;
        }

        hr {
            border: 0;
            border-bottom: 1.5px dashed #111;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            padding: 4px 0;
        }
        table td:first-child, table td:nth-child(2) {
            padding-right: 6px;
        }

        table.data tbody tr:last-child td, table tr.border-bottom td {
            border-bottom: 1.5px dashed #111;
        }

        table tr.padding-top td {
            padding-top: 8px;
        }
        table.data tbody tr:last-child td, table tr.padding-bottom td {
            padding-bottom: 8px;
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }

        @media print {
            @page {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <header>
        <p class="title">{{ config('setting.name') }}</p>
        <p>{{ config('setting.address') }}</p>
        <p>{{ config('setting.phone') }}</p>
    </header>

    <hr>

    <table class="user">
        <tr>
            <td>Nota</td>
            <td width="1px">:</td>
            <td align="right">{{ $order->invoice }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td width="1px">:</td>
            <td align="right">{{ date('d-m-y H:i', strtotime($order->created_at)) }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td width="1px">:</td>
            <td align="right">{{ $order->user->name ?? 'Umum' }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td width="1px">:</td>
            <td align="right">{{ $order->admin->name ?? '-'  }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td width="1px">:</td>
            <td align="right">{{ $order->payment_method_name ?? '-'  }}</td>
        </tr>
    </table>

    <hr>

    <table class="data">
        <tbody>
            @php
                $total = 0
            @endphp

            @foreach ($carts as $item)
                @php
                    $menu = $item->menu;
                    $isBarOrKoki = auth()->user()->canany(['bar', 'koki']);
                    $isBar = auth()->user()->can('bar');
                    $isKoki = auth()->user()->can('koki');
                @endphp

                @if (!$isBarOrKoki || ($isBar && $menu->type === 'drink') || ($isKoki && $menu->type === 'food'))
                    @php
                        $subtotal = $item->qty * $menu->price;
                        $total += $subtotal;
                    @endphp
                    <tr valign="top">
                        <td>
                            {{ $menu->name }} x {{ $item->qty }} <br>
                            Rp {{ number_format($menu->price) }}
                        </td>
                        <td>Rp</td>
                        <td align="right">{{ number_format($subtotal) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            @php
                $tax = 15 / 100 * $total;
                $additional_price = $order->hasAdditionalPrice ? 1 / 100 * $total : 0;
                $grand_total = $total + $tax + $additional_price;
            @endphp
            @canany(['bar', 'koki'])
            <tr class="padding-top">
                <td>Subtotal</td>
                <td>Rp</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
            @endcan
                    
            @canany(['admin', 'pelayanan', 'kasir'])
            <tr class="padding-top">
                <td>Subtotal</td>
                <td>Rp</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
            <tr class="padding-top">
                <td>Tax dan Service (15%)</td>
                <td>Rp</td>
                <td align="right">{{ number_format($tax) }}</td>
            </tr>
            @if ($order->hasAdditionalPrice)
            <tr class="padding-top">
                <td>BCA CARD (1%)</td>
                <td>Rp</td>
                <td align="right">{{ number_format($additional_price) }}</td>
            </tr>
            @endif
            <tr class="padding-top padding-bottom border-bottom">
                <td>Total</td>
                <td>Rp</td>
                <td align="right">{{ number_format($grand_total) }}</td>
            </tr>
            <tr class="border-top border-bottom padding-top padding-bottom">
                <td>Grand Total</td>
                <td>Rp</td>
                <td align="right">{{ number_format($grand_total) }}</td>
            </tr>
            <tr class="padding-top">
                <td>Terbayar</td>
                <td>Rp</td>
                <td align="right">{{ number_format($order->paid) }}</td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td>Rp</td>
                <td align="right">{{ $order->fine }}</td>
            </tr>
            @endcan
        </tfoot>
    </table>

    <footer>Terima Kasih - Silakan datang lagi</footer>

    <script>
        window.onload = () => {
            window.print()
        }
    </script>
    
</body>
</html>