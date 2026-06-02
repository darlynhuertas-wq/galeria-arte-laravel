<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Artista;
use App\Models\Obra;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador Galería',
            'email'    => 'admin@galeria.com',
            'password' => Hash::make('admin123'),
            'rol'      => 'admin',
        ]);

        User::create([
            'name'     => 'Juan Pérez',
            'email'    => 'juan@gmail.com',
            'password' => Hash::make('user123'),
            'rol'      => 'usuario',
        ]);

        $a1 = Artista::create(['nombre' => 'Leonardo da Vinci',  'nacionalidad' => 'Italiana',    'bio' => 'Polímata del Renacimiento italiano, conocido por la Mona Lisa y La Última Cena.']);
        $a2 = Artista::create(['nombre' => 'Vincent van Gogh',   'nacionalidad' => 'Neerlandesa', 'bio' => 'Exponente principal del postimpresionismo, famoso por La noche estrellada.']);
        $a3 = Artista::create(['nombre' => 'Pablo Picasso',      'nacionalidad' => 'Española',    'bio' => 'Creador del movimiento cubista, autor de Guernica y Las señoritas de Aviñón.']);

        Obra::create(['titulo' => 'Mona Lisa',           'tecnica' => 'Óleo sobre tabla',   'anio' => 1503, 'precio' => 1200000.00, 'imagen' => 'mona_lisa.jpg',        'artista_id' => $a1->id]);
        Obra::create(['titulo' => 'La noche estrellada', 'tecnica' => 'Óleo sobre lienzo',  'anio' => 1889, 'precio' =>  850000.50, 'imagen' => 'noche_estrellada.jpg', 'artista_id' => $a2->id]);
        Obra::create(['titulo' => 'Guernica',            'tecnica' => 'Óleo sobre lienzo',  'anio' => 1937, 'precio' => 2300000.00, 'imagen' => null,                   'artista_id' => $a3->id]);
        Obra::create(['titulo' => 'La Última Cena',      'tecnica' => 'Tempera sobre yeso', 'anio' => 1498, 'precio' =>  950000.00, 'imagen' => null,                   'artista_id' => $a1->id]);
        Obra::create(['titulo' => 'Los girasoles',       'tecnica' => 'Óleo sobre lienzo',  'anio' => 1888, 'precio' =>  640000.00, 'imagen' => null,                   'artista_id' => $a2->id]);
    }
}