<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Artista;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Carga la galería pública aplicando los filtros de búsqueda que ya tenías
    public function galeria(Request $request)
    {
        $buscar = $request->input('buscar');
        $artista_id = $request->input('artista_id');

        $obras = Obra::with('artista')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('titulo', 'LIKE', "%{$buscar}%");
            })
            ->when($artista_id, function ($query, $artista_id) {
                return $query->where('artista_id', $artista_id);
            })
            ->get();

        $artistas = Artista::all();

        return view('usuario.galeria', compact('obras', 'artistas'));
    }

    // Agregar obra al carrito (Límite inicial)
    public function agregar(Request $request, $id)
    {
        $obra = Obra::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] >= 10) {
                return redirect()->back()->with('error', '⚠️ No puede adquirir más de 10 unidades de esta obra.');
            }
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'titulo'   => $obra->titulo,
                'precio'   => $obra->precio,
                'imagen'   => $obra->imagen,
                'artista'  => $obra->artista->nombre ?? 'Autor Anónimo',
                'cantidad' => 1
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->route('galeria.index')->with('success', '🎨 Obra añadida al carrito de compras.');
    }

    // Renderizar la vista analítica del carrito
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $obrasCarrito = [];
        $total = 0;

        foreach ($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;

            $obrasCarrito[] = [
                'id'       => $id,
                'titulo'   => $item['titulo'],
                'precio'   => $item['precio'],
                'imagen'   => $item['imagen'],
                'artista'  => $item['artista'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $subtotal
            ];
        }

        return view('usuario.carrito', compact('obrasCarrito', 'total'));
    }

    // Incrementar cantidad con tope estricto de 10
    public function incrementar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] >= 10) {
                return redirect()->route('carrito.ver')->with('error', '⚠️ Límite máximo alcanzado. No se permiten más de 10 copias de esta obra.');
            }
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver');
    }

    // Decrementar cantidad
    public function decrementar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
                session()->put('carrito', $carrito);
            } else {
                unset($carrito[$id]);
                session()->put('carrito', $carrito);
            }
        }

        return redirect()->route('carrito.ver');
    }

    // Eliminar producto
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver')->with('success', '🗑️ Artículo removido del carrito.');
    }
}