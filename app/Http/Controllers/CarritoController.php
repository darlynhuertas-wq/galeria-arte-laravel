<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Artista;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function galeria(Request $request)
    {
        $buscar     = $request->buscar;
        $artista_id = $request->artista_id;
        $tecnica    = $request->tecnica;
        $precio     = $request->precio;
        $orden      = $request->orden;

        $obras = Obra::with('artista')

            ->when($buscar, function ($q) use ($buscar) {
                $q->where('titulo', 'LIKE', "%{$buscar}%");
            })

            ->when($artista_id, function ($q) use ($artista_id) {
                $q->where('artista_id', $artista_id);
            })

            ->when($tecnica, function ($q) use ($tecnica) {
                $q->where('tecnica', $tecnica);
            })

            ->when($precio == 1, function ($q) {
                $q->where('precio', '<', 5000);
            })

            ->when($precio == 2, function ($q) {
                $q->whereBetween('precio', [5000, 20000]);
            })

            ->when($precio == 3, function ($q) {
                $q->where('precio', '>', 20000);
            });

        if ($orden == 'precio_asc') {
            $obras->orderBy('precio', 'asc');
        }

        if ($orden == 'precio_desc') {
            $obras->orderBy('precio', 'desc');
        }

        if ($orden == 'reciente') {
            $obras->orderBy('anio', 'desc');
        }

        if ($orden == 'antiguo') {
            $obras->orderBy('anio', 'asc');
        }

        if ($orden == 'az') {
            $obras->orderBy('titulo', 'asc');
        }

        if ($orden == 'za') {
            $obras->orderBy('titulo', 'desc');
        }

        $obras = $obras->get();

        $artistas = Artista::all();

        return view('usuario.galeria', compact('obras', 'artistas'));
    }    
    public function detalle($id)
    {
        $obra = Obra::with('artista')->findOrFail($id);
        return view('usuario.detalle', compact('obra'));
    }

    public function agregar(Request $request, $id)
    {
        $obra    = Obra::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] >= 10) {
                return redirect()->back()->with('error', 'No puede adquirir más de 10 unidades de esta obra.');
            }
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'titulo'   => $obra->titulo,
                'precio'   => $obra->precio,
                'imagen'   => $obra->imagen,
                'artista'  => $obra->artista->nombre ?? 'Autor Anónimo',
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Obra añadida al carrito de compras.');
    }

    public function verCarrito()
    {
        $carrito      = session()->get('carrito', []);
        $obrasCarrito = [];
        $total        = 0;

        foreach ($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total   += $subtotal;

            $obrasCarrito[] = [
                'id'       => $id,
                'titulo'   => $item['titulo'],
                'precio'   => $item['precio'],
                'imagen'   => $item['imagen'],
                'artista'  => $item['artista'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $subtotal,
            ];
        }

        return view('usuario.carrito', compact('obrasCarrito', 'total'));
    }

    public function incrementar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] >= 10) {
                return redirect()->route('carrito.ver')->with('error', 'Límite máximo de 10 unidades alcanzado.');
            }
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver');
    }

    public function decrementar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            } else {
                unset($carrito[$id]);
            }
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.ver')->with('success', 'Artículo eliminado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.ver')->with('success', 'El carrito ha sido vaciado completamente.');
    }
    public function confirmar()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)){
            return redirect()->route('carrito.ver');
        }

        $total = 0;

        foreach($carrito as $item){
            $total += $item['precio'] * $item['cantidad'];
        }

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'total' => $total
        ]);

        foreach($carrito as $obraId => $item){

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'obra_id' => $obraId,
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio']
            ]);

        }

        session()->forget('carrito');

        return redirect()
            ->route('mis-compras')
            ->with('success','Compra realizada correctamente.');
    }
    public function misCompras()
    {
        $pedidos = Pedido::with('detalles.obra')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('usuario.mis-compras', compact('pedidos'));
    }
}