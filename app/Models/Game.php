<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
    'judul',
    'kategori_id',
    'developer_id',
    'tahun',
    'deskripsi',
    'gambar',
];


    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function developer() {
        return $this->belongsTo(Developer::class);
    }
}

