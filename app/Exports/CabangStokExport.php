<?php

namespace App\Exports;

use App\Models\CabangStok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CabangStokExport implements FromCollection, WithHeadings
{
    protected $cabangStoks;

    public function __construct($cabangStoks)
    {
        $this->cabangStoks = $cabangStoks;
    }
    public function collection()
    {
        return $this->cabangStoks->map(function ($stok) {
            return [
                'ID' => $stok->id,
                'Nama Produk' => $stok->produk->nama,
                'Jumlah' => $stok->jumlah,
                'Cabang' => $stok->cabang->nama,
                'Tanggal Stok' => $stok->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Jumlah',
            'Cabang',
            'Tanggal Stok',
        ];
    }
}