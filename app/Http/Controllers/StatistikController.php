<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Kategori;
use App\Models\Developer;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        $totalGames = Game::count();
        $totalKategori = Kategori::count();
        $totalDeveloper = Developer::count();

        $gamePerKategori = Kategori::withCount('games')->get();
        $gamePerTahun = Game::select('tahun', DB::raw('count(*) as total'))
                            ->groupBy('tahun')
                            ->orderBy('tahun')
                            ->get();

        return view('statistik.index', compact(
            'totalGames',
            'totalKategori',
            'totalDeveloper',
            'gamePerKategori',
            'gamePerTahun'
        ));
    }
}
