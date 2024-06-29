<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TujuanRekening;

class TujuanRekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            'Bank Mandiri',
            'Bank BRI (Bank Rakyat Indonesia)',
            'BCA (Bank Central Asia)',
            'Bank BNI (Bank Negara Indonesia)',
            'Bank CIMB Niaga',
            'Bank Danamon',
            'Bank Mega',
            'Bank OCBC NISP',
            'Bank BTN (Bank Tabungan Negara)',
            'Bank BTPN',
            'Bank Permata',
            'Bank Maybank Indonesia',
            'Bank DBS Indonesia',
            'Bank HSBC Indonesia',
            'Bank UOB Indonesia',
            'Bank Bukopin',
            'Bank Panin',
            'Bank Muamalat Indonesia',
            'Bank BJB (Bank Jabar Banten)',
            'Bank Jatim (Bank Pembangunan Daerah Jawa Timur)',
            'Bank Jateng (Bank Pembangunan Daerah Jawa Tengah)',
            'Bank DKI (Bank Pembangunan Daerah DKI Jakarta)',
            'Bank Jago',
            'Bank BCA Digital (BLU)',
            'Bank Digibank by DBS',
            //E-wallet
            'OVO',
            'GoPay',
            'DANA',
            'LinkAja',
            'ShopeePay',
            'Jenius (by BTPN)',
            'TCASH (Telkomsel)',
            'Doku Wallet',
            'iSaku (by Bank BRI)',
            'AstraPay',
        ];

        // Insert data bank
        foreach ($banks as $bank) {
            TujuanRekening::create(['nama' => $bank]);
        }
    }
}