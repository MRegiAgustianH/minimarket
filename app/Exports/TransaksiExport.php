<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    protected $transaksis;

    public function __construct($transaksis)
    {
        $this->transaksis = $transaksis;
    }

    public function collection()
    {
        return $this->transaksis->map(function ($transaksi) {
            return [
                'ID' => $transaksi->id,
                'Nama Produk' => $transaksi->produk->nama,
                'Jumlah' => $transaksi->jumlah,
                'Harga' => $transaksi->total_harga,
                'Tanggal Transaksi' => $transaksi->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Jumlah',
            'Harga',
            'Tanggal Transaksi',
        ];
    }
}