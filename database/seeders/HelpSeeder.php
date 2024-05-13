<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Help;

class HelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Help $help)
    {
        $help->create([
            'content' => 'Petunjuk Penggunaan Aplikasi Restoran

Petunjuk Pemesanan

- Pilih menu yang akan dibeli di menu beranda
- Lalu klik tombol proses
- Pilih tipe order dan no meja
- Lalu klik tombol order
- Tunjukan detail transaksi pada kasir

Petunjuk Pembayaran

Setelah selesai makan, pergi ke kasir untuk pembayaran dan pencetakan struk'
        ]);
    }
}
