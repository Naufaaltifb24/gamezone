<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function results(Request $request)
{
    $keyword = $request->search;

    $games = Game::with(['kategori', 'developer'])
        ->where(function ($query) use ($keyword) {
            $query->where('judul', 'like', "%$keyword%")
                  ->orWhereHas('kategori', fn($q) => $q->where('nama', 'like', "%$keyword%"))
                  ->orWhereHas('developer', fn($q) => $q->where('name', 'like', "%$keyword%"));
        })
        ->paginate(10);

    return view('search.results', compact('games', 'keyword'));
}

}
