<?php

namespace App\Exports;

use App\Models\Cicilan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KwitansiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth::guard('customer')->user()->cicilan->tagihan;
    }

    private $counter = 0;

    public function headings(): array
    {
        return [
            'Cicilan ke',
            'Tanggal Jatuh Tempo',
            'Cicilan/Bulan',
            'Tanggal Bayar',
            'Terlambat(Hari)',
            'Nominal Denda',
            'Total Bayar',
        ];
    }

    public function map($tagihan): array
    {

        $this->counter++;
        return [
            $this->counter,
            '10 ' . bulan_only(ltrim($tagihan->bulan, '0')) . ' ' . $tagihan->tahun,
            number_format($tagihan->cicilan->cicilan, 0, ',', '.'),
            date_format($tagihan->created_at, 'd ') . bulan($tagihan->created_at),
            $tagihan->bayarBerhasil ? $tagihan->bayarBerhasil->denda : 0,
            number_format(($tagihan->bayarBerhasil ? $tagihan->bayarBerhasil->denda : 0 / 100) * $tagihan->bayarBerhasil->customer->cicilan->cicilan, 0, ',', '.'),
            number_format($tagihan->bayarBerhasil->nominal, 0, ',', '.'),
        ];
    }
}
