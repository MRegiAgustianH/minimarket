<?php

namespace App\Http\Controllers;

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
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Memeriksa apakah user memiliki role supervisor
        if ($user->hasRole('supervisor')) {
            // Ambil semua transaksi untuk cabang yang dikelola oleh supervisor
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)->get();
        } elseif ($user->hasRole('kasir')) {
            // Ambil transaksi berdasarkan cabang yang dipegang oleh kasir
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)->get();
        } else {
            // Jika bukan supervisor atau kasir, ambil semua transaksi
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

        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);
        $produk = Produk::find($request->produk_id);
        $total_harga = $produk->harga * $request->jumlah;
 
        Transaksi::create([
            'cabang_id' => $request->cabang_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'user_id' => Auth::id(), 
            'total_harga' => $total_harga,
        ]);
    
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
