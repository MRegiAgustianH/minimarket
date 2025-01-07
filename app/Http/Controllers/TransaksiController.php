<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\CabangStok;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            $uniqueDates = Transaksi::where('cabang_id', $user->cabang_id)
            ->selectRaw('DATE(created_at) as date')
            ->groupBy('date')
            ->pluck('date');
        } elseif ($user->hasRole('kasir')) {
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)->get();
            $uniqueDates = null;
        } else {
            $transaksis = Transaksi::all();
            $uniqueDates = null;
        }

        return view('transaksi.index', compact('transaksis', 'uniqueDates'));
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
            'cabang_id' => 'required|exists:cabangs,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        
        $produk = Produk::find($request->produk_id);

        
        $total_harga = $produk->harga * $request->jumlah;

        
        $cabangStok = CabangStok::where('cabang_id', $request->cabang_id)
            ->where('produk_id', $request->produk_id)
            ->first();

        
        if (!$cabangStok || $cabangStok->jumlah < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk produk ini.');
        }

        
        Transaksi::create([
            'cabang_id' => $request->cabang_id,
            'user_id' => Auth::id(),
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
        ]);

        
        $cabangStok->jumlah -= $request->jumlah;
        $cabangStok->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke transaksi.');
    }

    public function struk($id)
    {
        $transaksi = Transaksi::with('produk')->findOrFail($id); 
        return view('transaksi.struk', compact('transaksi'));
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $tanggal = $request->input('tanggal');

        if ($user->hasRole('supervisor')) {
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)
                ->whereDate('created_at', $tanggal)
                ->get();
        } elseif ($user->hasRole('kasir')) {
            $transaksis = Transaksi::where('cabang_id', $user->cabang_id)
                ->whereDate('created_at', $tanggal)
                ->get();
        } else {
            $transaksis = Transaksi::whereDate('created_at', $tanggal)->get();
        }

        
        return Excel::download(new TransaksiExport($transaksis), 'transaksi_' . $tanggal . '.xlsx');
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
