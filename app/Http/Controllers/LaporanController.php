<?php

namespace App\Http\Controllers;

use App\Models\CabangStok;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transaksiBulanan = Transaksi::whereMonth('created_at', now()->month)->get();
        return view('laporan.index', $transaksiBulanan);
    }

    public function transaksi(){
        return view('laporan.transaksi');
    }

    public function stok(){

        return view('laporan.stok');
    }

    public function laporanTransaksi(Request $request)
    {
        
        $transaksis = Transaksi::all();
        $transaksiHarian = Transaksi::whereDate('created_at', today())->get();
        $transaksiBulanan = Transaksi::whereMonth('created_at', now()->month)->get();
        $transaksiTahunan = Transaksi::whereYear('created_at', now()->year)->get();

        return view('laporan.transaksi', compact('transaksiHarian', 'transaksiBulanan', 'transaksiTahunan', 'transaksis'));
    }

    public function laporanStok(Request $request)
    {
        
        $stokHarian = CabangStok::whereDate('updated_at', today())->get();
        $stokBulanan = CabangStok::whereMonth('updated_at', now()->month)->get();
        $stokTahunan = CabangStok::whereYear('updated_at', now()->year)->get();

        return view('laporan.stok', compact('stokHarian', 'stokBulanan', 'stokTahunan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
