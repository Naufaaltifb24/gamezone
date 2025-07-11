<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Kategori;
use App\Models\Developer;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with(['kategori', 'developer']);

        if ($request->search) {
            $keyword = $request->search;
            $query->where('judul', 'like', "%$keyword%")
                ->orWhereHas('kategori', fn($q) => $q->where('nama', 'like', "%$keyword%"))
                ->orWhereHas('developer', fn($q) => $q->where('name', 'like', "%$keyword%"));
        }

        $games = $query->latest()->paginate(5);

        if ($request->ajax()) {
            return response()->view('games.index', compact('games'));
        }

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $developers = Developer::all();
        return view('games.create', compact('kategoris', 'developers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'developer_id' => 'required',
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'judul', 'kategori_id', 'developer_id', 'tahun', 'deskripsi',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('games', $filename, 'public');
            $data['gambar'] = $filename;
        }

        $game = Game::create($data);

        Log::create([
            'aktivitas' => 'Menambahkan game: ' . $game->judul,
            
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan');
    }

    public function edit(Game $game)
    {
        $kategoris = Kategori::all();
        $developers = Developer::all();
        return view('games.edit', compact('game', 'kategoris', 'developers'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'developer_id' => 'required',
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'kategori_id', 'developer_id', 'tahun', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($game->gambar && Storage::disk('public')->exists('games/' . $game->gambar)) {
                Storage::disk('public')->delete('games/' . $game->gambar);
            }

            $file = $request->file('gambar');
            $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('games', $filename, 'public');
            $data['gambar'] = $filename;
        }

        $game->update($data);

        Log::create([
            'aktivitas' => 'Memperbarui game: ' . $game->judul,
            
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil diperbarui');
    }

    public function show(Game $game)
    {
        $game->load(['kategori', 'developer']);
        return view('games.show', compact('game'));
    }

    public function destroy(Game $game)
    {
        if ($game->gambar && Storage::disk('public')->exists('games/' . $game->gambar)) {
            Storage::disk('public')->delete('games/' . $game->gambar);
        }

        $judul = $game->judul;
        $game->delete();

        Log::create([
            'aktivitas' => 'Menghapus game: ' . $judul,
            
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil dihapus');
    }
}
