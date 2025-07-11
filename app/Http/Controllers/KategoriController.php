<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kategoris = $query->latest()->paginate(5);

        if ($request->ajax()) {
            return response()->view('kategori.index', compact('kategoris'))
                             ->header('Content-Type', 'text/html');
        }

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $kategori = Kategori::create($request->only('nama'));

        // Tambahkan log aktivitas
        Log::create([
            'aktivitas' => 'Menambahkan kategori: ' . $kategori->nama,
            'user_id' => Auth::id(),
        ]);

        if ($request->ajax()) {
            return response()->json($kategori);
        }

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $kategori->update($request->only('nama'));

        // Tambahkan log aktivitas
        Log::create([
            'aktivitas' => 'Memperbarui kategori: ' . $kategori->nama,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $nama = $kategori->nama;
        $kategori->delete();

        // Tambahkan log aktivitas
        Log::create([
            'aktivitas' => 'Menghapus kategori: ' . $nama,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
