<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
//Usar el modelo
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Mostrar elementos en la base de datos
     */
    public function index()
    {
        $libros = Libro::all();

        return view('Libros.index', compact('libros'));
    }

    /**
     * Funcion insertar
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Guardar informacion en la base de datos
     */
    public function store(Request $request)
    {
        Libro::create([
            //nombreFomrulario => $request-><NombreBD>
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'precio' => $request->precio
        ]);

        //Redireccionar al usuario al formulario
        return redirect()->route('libros.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Editar registro
     */
    public function edit(Libro $libro)
    {
        //regresar datos del libro
        return view('libros.edit', compact('libro'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'nombre' => 'required',
            'autor'  => 'required',
            'editorial' =>  'required',
            'precio' => 'required',
        ]);
        //Indicar actualizacion de todos los campos
        $libro->update($request->all());

        return redirect()->route('libros.index')
        ->with('success', 'Actualizacion Exitosa');
    }

    /**
     * Eliminar
     */
    public function destroy(Libro $libro)
    {
        //funcion para eliminar registro
        $libro -> delete();

        return redirect()->route('libros.index')
        ->with('success', 'Libro eliminado');
    }
}
