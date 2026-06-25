<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // 1. Mostrar todas las categorías (GET)
    public function index()
    {
        return response()->json(Categoria::all(), 200);
    }

    // 2. Crear una nueva categoría (POST)
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'slug'   => 'required|string|unique:categorias,slug|max:100',
        ]);

        $categoria = Categoria::create($data);
        return response()->json($categoria, 201); // 201 = Creado
    }

    // 3. Mostrar una categoría en específico (GET)
    public function show(Categoria $categoria)
    {
        return response()->json($categoria, 200);
    }

    // 4. Actualizar una categoría (PUT/PATCH)
    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'slug'   => 'sometimes|required|string|max:100|unique:categorias,slug,' . $categoria->id,
        ]);

        $categoria->update($data);
        return response()->json($categoria, 200);
    }

    // 5. Eliminar una categoría (DELETE)
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(['mensaje' => 'Categoría eliminada'], 200);
    }
}