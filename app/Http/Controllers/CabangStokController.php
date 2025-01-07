<?php

namespace App\Http\Controllers;

use App\Exports\CabangStokExport;
use App\Exports\StokExport;
use App\Models\Cabang;
use App\Models\CabangStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CabangStokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        if ($user) {
            if ($user->hasRole('supervisor')) {
                $cabangStoks = CabangStok::with(['cabang', 'produk'])
                    ->where('cabang_id', $user->cabang_id)
                    ->get();
    
                // Ambil tanggal unik dari data stok
                $uniqueDates = CabangStok::where('cabang_id', $user->cabang_id)
                    ->selectRaw('DATE(created_at) as date')
                    ->groupBy('date')
                    ->pluck('date');
            } elseif ($user->hasRole('manager')) {
                $cabangStoks = CabangStok::with(['cabang', 'produk'])->get();
                $uniqueDates = CabangStok::selectRaw('DATE(created_at) as date')
                    ->groupBy('date')
                    ->pluck('date');
            } elseif ($user->hasRole('pegawai')) {
                $cabangStoks = CabangStok::with(['cabang', 'produk'])->get();
                return view('gudang.index', compact('cabangStoks'));
            } else {
                $cabangStoks = collect();
                $uniqueDates = collect();
            }
        } else {
            $cabangStoks = collect();
            $uniqueDates = collect();
        }
    
        return view('cabang.stok', compact('cabangStoks', 'uniqueDates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cabangs = Cabang::all();
        $produks = Produk::all();
        return view('cabang.stok', compact('cabangs', 'produks'));
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
            'jumlah' => 'required|integer|min:0',
        ]);

        CabangStok::create($request->all());

        return redirect()->route('cabang.stok')->with('success', 'Stok produk berhasil ditambahkan.');
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $tanggal = $request->input('tanggal');

        $stoks = CabangStok::where('cabang_id', $user->cabang_id)
            ->whereDate('created_at', $tanggal)
            ->get();

        
        return Excel::download(new CabangStokExport($stoks), 'stok_' . $tanggal . '.xlsx');
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
