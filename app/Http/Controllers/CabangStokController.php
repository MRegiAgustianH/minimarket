<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\CabangStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            } elseif ($user->hasRole('manager')) {
                $cabangStoks = CabangStok::with(['cabang', 'produk'])->get();
            } elseif ($user->hasRole('pegawai')) {
                $cabangStoks = CabangStok::with(['cabang', 'produk'])->get();
                return view('gudang.index', compact('cabangStoks'));
            } else {
                $cabangStoks = collect();
            }
        } else {
            $cabangStoks = collect(); 
        }
        return view('cabang.stok', compact('cabangStoks'));
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
