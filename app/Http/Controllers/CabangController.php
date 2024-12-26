<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cabangs'] = Cabang::all();
        return view('cabang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data ['cabangs'] = Cabang::all();
        return view('cabang.create',$data);
        //
    }
    public function store(Request $request)
    {
         
         $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Cabang::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('cabang.index')->with('success', 'Cabang created successfully.');
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
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();
        return redirect()->route('cabang.index')->with('success', 'Cabang deleted successfully.');
    }
}
