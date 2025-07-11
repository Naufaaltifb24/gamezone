<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Kategori;
use App\Models\Developer;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ← Tambahkan ini

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalGames = Game::count();
        $totalKategori = Kategori::count();
        $totalDeveloper = Developer::count();

        $recentLogs = Log::with('user')->latest()->take(5)->get();
        $recentGames = Game::latest()->take(5)->get();

        $gamesPerKategori = DB::table('kategoris')
            ->leftJoin('games', 'kategoris.id', '=', 'games.kategori_id')
            ->select('kategoris.id', 'kategoris.nama', DB::raw('COUNT(games.id) as total'))
            ->groupBy('kategoris.id', 'kategoris.nama')
            ->orderByDesc('total')
            ->get();

        $kategoris = Kategori::all();
        $developers = Developer::all();

        $query = Game::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('developer_id')) {
            $query->where('developer_id', $request->developer_id);
        }

        $filteredGames = $query->latest()->get();

        return view('dashboard', compact(
            'totalGames',
            'totalKategori',
            'totalDeveloper',
            'recentLogs',
            'recentGames',
            'filteredGames',
            'kategoris',
            'developers',
            'gamesPerKategori' // jangan lupa kalau mau dipakai di view
        ));

        $query = Game::query()->with('kategori');

if ($request->search) {
    $keyword = $request->search;
    $query->where('judul', 'like', "%$keyword%")
        ->orWhereHas('kategori', fn($q) => $q->where('nama', 'like', "%$keyword%"));
}

    }
}
