<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GestionarLibros extends Controller
{

    public function getLibro(Request $r)
    {
        //obtener el isbn del formulario 'gestionarLibro'
        $isbn = $r->get('isbn');

        //verificar si el isbn ya existe en la base de datos
        $libroRegistrado = Libro::where('isbn', $isbn)->first();
        if ($libroRegistrado != null) {
            return view('libroExiste', ['isbn' => $isbn]);
        }

        //realizar la peticion a la API
        $respuesta = Http::get("https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data");

        if ($respuesta->successful()) {
            $libro = $respuesta->json();

            if (isset($libro["ISBN:$isbn"])) {
                if (isset($libro["ISBN:$isbn"]['title'])) { {
                        $titulo = $libro["ISBN:$isbn"]['title'];
                    }
                } else {
                    $titulo = 'titulo desconocido';
                }

                if (isset($libro["ISBN:$isbn"]['authors'][0]['name'])) {
                    $autor = $libro["ISBN:$isbn"]['authors'][0]['name'];
                } else {
                    $autor = 'Autor desconocido';
                }


                //retornar vista
                return view('registroLibro', [
                    'isbn' => $isbn,
                    'titulo' => $titulo,
                    'autor' => $autor
                ]);
            } else {
                // Si no se encuentra el libro, redirigir con un mensaje de error
                return back()->with('error', 'No se encontró el libro con ese ISBN');
            }
        } else {
            //retorna vista si la respuesta no fue exitosa
            return view('error');
        }
    }

    public function guardarLibro(Request $r)
    {
        //validar datos
        $r->validate([
            'isbn' => 'required|string|max:50',
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'nivel' => 'required|string|max:25',
            'ejemplares' => 'required|numeric'
        ]);

        //obtener los valores del formulario
        $isbn = $r->get('isbn');
        $titulo = $r->get('titulo');
        $autor = $r->get('autor');
        $nivel = $r->get('nivel');
        $ejemplares = $r->get('ejemplares');

        //creamos el libro
        $libro = new Libro();
        $libro->isbn = $isbn;
        $libro->titulo = $titulo;
        $libro->autor = $autor;
        $libro->nivel = $nivel;
        $libro->num_ejemplares = $ejemplares;
        $libro->save();

        //retornar vista
        return redirect()->route('mostrarLibros');
    }



    public function mostrarLibros()
    {
        //obtener todos los libros registrados
        $libros = Libro::all();

        // Pasar los libros a la vista mostrarLibros
        return view('gestionarLibros', compact('libros'));
    }

    public function eliminarLibro($id)
    {
        // Buscar el libro por ID
        $libro = Libro::find($id);

        // Verificar si el libro tiene préstamos asociados
        if ($libro->prestamos()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar el libro porque tiene préstamos activos. Elimine primero los prestamos.'
            ]);        
        }

        if ($libro) {
            // Eliminar el préstamo
            $libro->delete();

            // Redirigir con un mensaje de éxito
            return response()->json(['success' => true]);
        } else {
            // Si no se encuentra el préstamo, redirigir con un error
            return response()->json(['success' => false]);
        }
    }
}
