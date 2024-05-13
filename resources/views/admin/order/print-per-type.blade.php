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

        .separator {
            margin: 4rem 0;
        }

        .break {
            page-break-before: always;
        }

        @media print {
            @page {
                margin: 0;
                padding: 0;
            }

            .separator {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- makanan -->
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

            @foreach ($order->menus as $menu)
                @if ($menu->type === 'food')
                    @php
                        $subtotal = $menu->pivot->quantity * $menu->price;
                        $total += $subtotal;
                    @endphp
                    <tr valign="top">
                        <td>
                            {{ $menu->name }} x {{ $menu->pivot->quantity }} <br>
                            Rp {{ $menu->price_formatted }}
                        </td>
                        <td>Rp</td>
                        <td align="right">{{ number_format($subtotal) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr class="padding-top">
                <td>Subtotal</td>
                <td>Rp</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
        </tfoot>
    </table>

    <footer>Terima Kasih - Silakan datang lagi</footer>

    <hr class="separator">
    <div class="break"></div>

    <!-- minuman -->
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

            @foreach ($order->menus as $menu)
                @if ($menu->type === 'drink')
                    @php
                        $subtotal = $menu->pivot->quantity * $menu->price;
                        $total += $subtotal;
                    @endphp
                    <tr valign="top">
                        <td>
                            {{ $menu->name }} x {{ $menu->pivot->quantity }} <br>
                            Rp {{ $menu->price_formatted }}
                        </td>
                        <td>Rp</td>
                        <td align="right">{{ number_format($subtotal) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr class="padding-top">
                <td>Subtotal</td>
                <td>Rp</td>
                <td align="right">{{ number_format($total) }}</td>
            </tr>
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