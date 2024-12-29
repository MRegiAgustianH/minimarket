<?php

namespace App\Http\Controllers;

use App\Models\CabangStok;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); 
        if ($user->hasRole('supervisor')) {
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)->get();
        } elseif ($user->hasRole('kasir')) {
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)->get();
        } else {
            $transaksis = Transaksi::all();
        }

        return view('transaksi.index', ['transaksis' => $transaksis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data ['transaksis'] = Transaksi::all();
        return view('transaksi.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Mencari produk berdasarkan ID
        $produk = Produk::find($request->produk_id);

        // Menghitung total harga
        $total_harga = $produk->harga * $request->jumlah;

        // Mencari stok cabang untuk produk yang dipilih
        $cabangStok = CabangStok::where('cabang_id', $request->cabang_id)
            ->where('produk_id', $request->produk_id)
            ->first();

        // Memastikan stok cukup
        if (!$cabangStok || $cabangStok->jumlah < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk produk ini.');
        }

        // Menyimpan transaksi
        Transaksi::create([
            'cabang_id' => $request->cabang_id,
            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
        ]);

        // Mengurangi stok di tabel cabang_stok
        $cabangStok->jumlah -= $request->jumlah;
        $cabangStok->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke transaksi.');
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
