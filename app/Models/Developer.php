<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
