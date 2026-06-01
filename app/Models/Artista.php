<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model {
    protected $table = 'artistas';
    protected $fillable = ['nombre', 'nacionalidad', 'bio'];

    public function obras() {
        return $this->hasMany(Obra::class, 'artista_id');
    }
}