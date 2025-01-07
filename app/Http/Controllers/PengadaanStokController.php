<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\CabangStok;
use App\Models\PengadaanStok;
use App\Models\Produk;
use Illuminate\Http\Request;

class PengadaanStokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pengadaanStoks = PengadaanStok::all();
        return view('gudang.index', compact('pengadaanStoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $cabangs = Cabang::all();
        $produks = Produk::all();

    return view('gudang.create', compact('cabangs', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengadaan' => 'required|date',
        ]);

        PengadaanStok::create([
            'cabang_id' => $request->cabang_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
        ]);

        return redirect()->back()->with('success', 'Pengadaan stok berhasil diajukan.');
    }

    public function approve($id){

        $pengadaan = PengadaanStok::findOrFail($id);

        $cabangStok = CabangStok::where('cabang_id', $pengadaan->cabang_id)
            ->where('produk_id', $pengadaan->produk_id)
            ->first();

        if ($cabangStok) {
            $cabangStok->jumlah += $pengadaan->jumlah;
            $cabangStok->save();
        }

        $pengadaan->status = 'approved'; 
        $pengadaan->save();

        return redirect()->back()->with('success', 'Pengadaan stok berhasil disetujui.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
