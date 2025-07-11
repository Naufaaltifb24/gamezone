<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {
        $developers = Developer::when($request->search, function($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%");
        })->paginate(10);

        if ($request->ajax()) {
            return response()->view('developers.index', compact('developers'));
        }

        return view('developers.index', compact('developers'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $developer = Developer::create($request->only('name'));

        // Log aktivitas
        Log::create([
            'aktivitas' => 'Menambahkan developer: ' . $developer->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('developers.index')->with('success', 'Developer berhasil ditambahkan');
    }

    public function edit(Developer $developer)
    {
        return view('developers.edit', compact('developer'));
    }

    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $developer->update($request->only('name'));

        // Log aktivitas
        Log::create([
            'aktivitas' => 'Memperbarui developer: ' . $developer->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('developers.index')->with('success', 'Developer berhasil diperbarui');
    }

    public function destroy(Developer $developer)
    {
        $nama = $developer->name;

        $developer->delete();

        // Log aktivitas
        Log::create([
            'aktivitas' => 'Menghapus developer: ' . $nama,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('developers.index')->with('success', 'Developer berhasil dihapus');
    }
}
