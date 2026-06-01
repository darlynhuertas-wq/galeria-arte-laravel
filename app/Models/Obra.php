<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model {
    protected $table = 'obras';
    protected $fillable = ['titulo', 'tecnica', 'anio', 'precio', 'imagen', 'artista_id'];

    public function artista() {
        return $this->belongsTo(Artista::class, 'artista_id');
    }
}