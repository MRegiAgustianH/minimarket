<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaksi::select('id', 'produk_id', 'jumlah', 'total_harga', 'created_at')
            ->with('produk') 
            ->get()
            ->map(function ($transaksi) {
                return [
                    'id' => $transaksi->id,
                    'nama_produk' => $transaksi->produk->nama, 
                    'jumlah' => $transaksi->jumlah,
                    'total_harga' => $transaksi->total_harga,
                    'tanggal_transaksi' => $transaksi->created_at->format('Y-m-d H:i:s'), 
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Jumlah',
            'Total Harga',
            'Tanggal Transaksi',
        ];
    }
}