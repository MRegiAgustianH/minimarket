<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['roles', 'cabang']) 
            ->whereHas('roles', function($query) {
                $query->where('name', '!=', 'owner'); 
            })
            ->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        $cabangs = Cabang::all();
        return view('user.create', compact('roles', 'cabangs'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'cabang_id' => 'nullable|exists:cabangs,id',
        ]);

        if ($request->role === 'supervisor') {
            $existingSupervisor = User::where('cabang_id', $request->cabang_id)
                ->whereHas('roles', function($query) {
                    $query->where('name', 'supervisor'); 
                })
                ->first();
        
            if ($existingSupervisor) {
                return redirect()->back()->withErrors(['cabang_id' => 'Cabang ini sudah memiliki supervisor.']);
            }
        }
        if ($request->role === 'kasir') {
            $kasirCount = User::where('cabang_id', $request->cabang_id)
                ->whereHas('roles', function($query) {
                    $query->where('name', 'kasir');
                })
                ->count();
    
            if ($kasirCount >= 2) {
                return redirect()->back()->withErrors(['cabang_id' => 'Cabang ini sudah memiliki dua kasir.']);
            }
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cabang_id' => $request->role === 'supervisor' || $request->role === 'kasir' ? $request->cabang_id : null,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User  created successfully.');
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
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'cabang_id' => 'required_if:role,supervisor|exists:cabangs,id',
        ]);

        
        if ($request->role === 'supervisor' && $user->role->name !== 'supervisor') {
            
            $existingSupervisor = User::where('cabang_id', $request->cabang_id)
                ->whereHas('role', function($query) {
                    $query->where('name', 'supervisor');
                })
                ->first();

            if ($existingSupervisor) {
                return redirect()->back()->withErrors(['cabang_id' => 'Cabang ini sudah memiliki supervisor.']);
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cabang_id' => $request->cabang_id, 
        ]);

        
        if ($user->role->name !== $request->role) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('user.index')->with('success', 'User  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);

    // Menghapus pengguna
    $user->delete();

    return redirect()->route('user.index')->with('success', 'User  deleted successfully.');
    }
}
