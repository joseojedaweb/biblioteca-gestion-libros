<?php

use App\Http\Controllers\GestionarLibros;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//GESTIONAR LIBROS
// Ruta para obtener libro
Route::get('/libro', [GestionarLibros::class, 'getLibro'])->name('getLibro');
//ruta para guardar el libro
Route::post('/guardarLibro', [GestionarLibros::class, 'guardarLibro'])->name('guardarLibro');
// Ruta para mostrar todos los libros
Route::get('/libros', [GestionarLibros::class, 'mostrarLibros'])->name('mostrarLibros');


//AÑADIR/ELIMINAR PRESTAMO
//mostrar formulario para buscar isbn que este en la base de datos
Route::get('/isbn-prestamo', [PrestamoController::class, 'formularioIsbnPrestamo'])->name('formulario_IsbnPrestamo');
//procesar el formulario 
Route::post('/isbn-prestamo', [PrestamoController::class, 'procesarFormularioPrestamo'])->name('procesar_FormularioPrestamo');
//crear prestamo
Route::post('/crear-prestamo', [PrestamoController::class, 'procesarCrearPrestamo'])->name('procesar_CrearPrestamo');

//ELIMINAR PRESTAMO
Route::get('/eliminar-prestamo/{id}', [PrestamoController::class, 'eliminarPrestamo'])->name('eliminarPrestamo');


//MOSTRAR TODOS LOS PRESTAMOS
Route::get('/prestamos', [PrestamoController::class, 'mostrarTodosPrestamos'])->name('mostrar_TodosPrestamos');

// Eliminar libro
Route::get('/eliminar-libro/{id}', [GestionarLibros::class, 'eliminarLibro'])->name('eliminarLibro');


require __DIR__.'/auth.php';
