<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function formularioIsbnPrestamo()
    {
        return view('isbnPrestamo');
    }


    public function procesarFormularioPrestamo(Request $r)
    {

        //validar datos
        $r->validate([
            'isbn' => 'required|string|max:50',
        ]);

        //obtener los valores del formulario
        $buscarIsbnBD = $r->get('isbn');
        // Consultar si el libro con ese ISBN existe en la base de datos
        $libroIsbn = Libro::where('isbn', $buscarIsbnBD)->first();

        // Inicializar la variable prestamos vacia
        $prestamos = [];

        //si el libro se encuentra, mostramos el formulario de crear el prestamo
        if ($libroIsbn) {
            // Obtener los prestamos de ese libro
            $prestamos = Prestamo::where('id_libro', $libroIsbn->id)->get();
        } else {
            return redirect()->back()->with('error', 'nose encontro el libro con ese isbn');
        }

        // Pasar la variable de prestamos siempre, incluso si no se encuentra el libro
        return view('isbnPrestamo', [
            'libro' => $libroIsbn,
            'isbn' => $buscarIsbnBD,
            'prestamos' => $prestamos
        ]);
    }

    public function procesarCrearPrestamo(Request $r)
    {
        // Validar los datos del formulario
        $r->validate([
            'nombreAlumno' => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'required|string|max:100',
            'curso_grupo' => 'required|string|max:50',
        ]);

        // Obtener los valores del formulario
        $nombreAlumno = $r->get('nombreAlumno');
        $apellido1 = $r->get('apellido1');
        $apellido2 = $r->get('apellido2');
        $isbn = $r->get('isbn');

        $cursoGrupo = $r->get('curso_grupo');
        list($cursoNombre, $grupo) = explode(' ', $cursoGrupo, 2); // Divide el string en curso y grupo


        // Buscar el libro en la base de datos usando el ISBN
        $libro = Libro::where('isbn', $isbn)->first();

        if ($libro) {
            //verificar los num_ejemplares disponibles
            if ($libro->num_ejemplares > 0) {

                // Buscar el curso en la base de datos
                $curso = Curso::where('curso', $cursoNombre)
                    ->where('grupo', $grupo)
                    ->first();

                // Si no se encuentra el curso, crearlo
                if (!$curso) {
                    $curso = Curso::create([
                        'curso' => $cursoNombre,
                        'grupo' => $grupo,
                    ]);
                }

                // Crear el préstamo en la base de datos
                $prestamo = new Prestamo();
                $prestamo->nombre_alumno = $nombreAlumno;
                $prestamo->apellido1_alumno = $apellido1;
                $prestamo->apellido2_alumno = $apellido2;
                $prestamo->id_curso = $curso->id;  // Asociar prestamo con el curso
                $prestamo->id_libro = $libro->id;  // Asociar prestamo con el libro
                $prestamo->fecha = now();
                $prestamo->save();

                // Reducir el numero de ejemplares disponibles
                $libro->num_ejemplares -= 1;
                $libro->save();

                // Redirigir al usuario con un mensaje de éxito
                return redirect()->route('formulario_IsbnPrestamo')->with('success', 'Préstamo creado exitosamente.');
            } else {

                // Si no hay ejemplares disponibles
                return redirect()->back()->with('error', 'No hay ejemplares disponibles para préstamo.');
            }
        } else {
            // Si no se encuentra el libro, redirigir con un error
            return redirect()->back()->with('error', 'El libro con el ISBN proporcionado no existe.');
        }
    }

    public function eliminarPrestamo($id)
    {
        // Buscar el préstamo por ID
        $prestamo = Prestamo::find($id);

        // Verificar si el préstamo existe
        if ($prestamo) {
            //buscar el num_ejemplares del libro
            $libro = Libro::where('id', $prestamo->id_libro)->first();

            // Eliminar el préstamo
            $prestamo->delete();

            // Si se elimina el préstamo, volver a dejarlo disponible para préstamo
            if ($libro) {
                $libro->num_ejemplares += 1;
                $libro->save(); // Guardar la actualización en el libro
            }

            // Redirigir con un mensaje de éxito
            return response()->json(['success' => true]);
        } else {
            // Si no se encuentra el préstamo, redirigir con un error
            return response()->json(['success' => false]);
        }
    }

    public function mostrarTodosPrestamos()
    {
        $prestamoLibros = Prestamo::all();

        return view('todosLosPrestamos', ['prestamos' => $prestamoLibros]);
    }

    /* public function eliminarPrestamoVistaTodosLosPrestamos($id)
    {
        // Buscar el préstamo por ID
        $prestamo = Prestamo::find($id);

        // Verificar si el préstamo existe
        if ($prestamo) {
            // Eliminar el préstamo
            $prestamo->delete();

            // Redirigir con un mensaje de éxito
            //return redirect()->route('mostrar_TodosPrestamos')->with('success', 'Préstamo eliminado exitosamente.');
            return response()->json(['success' => true]);
        } else {
            // Si no se encuentra el préstamo, redirigir con un error
            //return redirect()->route('mostrar_TodosPrestamos')->with('error', 'Préstamo no encontrado.');
            return response()->json(['success' => false]);

        }
    }*/
}
