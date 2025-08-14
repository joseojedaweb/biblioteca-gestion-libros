<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <b>Añadir/eliminar prestamo</b>
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Parte 1: Formulario para isbn -->
                    <div class="mb-6">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Añadir/eliminar préstamo
                        </h3>
                        <form action="{{ route('procesar_FormularioPrestamo') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBM:</label>
                                    <input type="text" name="isbn" id="isbn" class="mt-1 block w-full" required>
                                </div>
                                <div class="mt-4">
                                    <input type="submit" value="Aceptar"
                                        class="bg-blue-600 text-dark px-6 py-2 rounded">
                                    <a href="{{ route('dashboard') }}"
                                        class="bg-gray-600 text-dark px-6 py-2 rounded">Cancelar</a>
                                </div>
                        </form>


                    </div><br>

                    <!-- Parte 2: Formulario para crear préstamo (se muestra si el libro se encuentra) -->
                    @isset($libro)
                                    <div class="mb-6 mt-8">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Crear préstamo para el
                                            libro: {{ $libro->titulo }}</h3>
                                        <form action="{{ route('procesar_CrearPrestamo') }}" method="POST">
                                            @csrf
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="nombreAlumno" class="block text-sm font-medium text-gray-700">Nombre
                                                        alumno:</label>
                                                    <input type="text" name="nombreAlumno" id="nombreAlumno" class="mt-1 block w-full"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="apellido1" class="block text-sm font-medium text-gray-700">Primer
                                                        apellido:</label>
                                                    <input type="text" name="apellido1" id="apellido1" class="mt-1 block w-full"
                                                        required>
                                                </div>
                                                <div>
                                                    <label for="apellido2" class="block text-sm font-medium text-gray-700">Segundo
                                                        apellido:</label>
                                                    <input type="text" name="apellido2" id="apellido2" class="mt-1 block w-full"
                                                        required>
                                                </div>
                                                <div class="flex gap-4">
                                                    <label for="curso_grupo" class="block text-sm font-medium text-gray-700">Curso y
                                                        Grupo:</label>
                                                    <select name="curso_grupo" id="curso_grupo" required>
                                                        <option value="1 ESO A">1 ESO A</option>
                                                        <option value="1 ESO B">1 ESO B</option>
                                                        <option value="1 ESO C">1 ESO C</option>
                                               
                                                        <option value="2 ESO A">2 ESO A</option>
                                                        <option value="2 ESO B">2 ESO B</option>
                                                        <option value="2 ESO C">2 ESO C</option>
                                                        <option value="2 ESO D">2 ESO D</option>

                                                        <option value="3 ESO A">3 ESO A</option>
                                                        <option value="3 ESO B">3 ESO B</option>
                                                        <option value="3 ESO C">3 ESO C</option>
                                                 
                                                        <option value="4 ESO A">4 ESO A</option>
                                                        <option value="4 ESO B">4 ESO B</option>
                                                        <option value="4 ESO C">4 ESO C</option>
                                                  
                                                        <option value="1 BACHILLER A">1 BACHILLER A</option>
                                                        <option value="1 BACHILLER B">1 BACHILLER B</option>
                                                        <option value="2 BACHILLER A">2 BACHILLER A</option>
                                                        <option value="2 BACHILLER B">2 BACHILLER B</option>
                                                    </select>

                                                </div>
                                                <input type="hidden" name="isbn" value="{{ $isbn }}">
                                            </div>
                                            <div class="mt-4">
                                                <input type="submit" value="Aceptar" class="bg-blue-600 text-dark px-6 py-2 rounded">
                                                <a href="{{ route('dashboard') }}"
                                                    class="bg-gray-600 text-dark px-6 py-2 rounded">Cancelar</a>
                                            </div>
                                        </form>
                                    </div>

                                    <!--Tabla de prestamos-->
                                    <div class="mt-8">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Lista prestamos libro:
                                            {{$libro->titulo}} </h3>
                                        <div class="overflow-x-auto">
                                            <table
                                                class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                                                <thead>
                                                    <tr class="bg-gray-200 dark:bg-gray-700">
                                                        <th class="py-2 px-4 border-b">Alumno</th>
                                                        <th class="py-2 px-4 border-b">Curso</th>
                                                        <th class="py-2 px-4 border-b">Fecha prestamo</th>
                                                        <th class="py-2 px-4 border-b">Cancelar prestamo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prestamos as $prestamo)
                                                                                    <tr class="border-t" id="file{{$prestamo->id}}">
                                                                                        <td class="py-2 px-4 border-b">{{ $prestamo->nombre_alumno }}
                                                                                            {{ $prestamo->apellido1_alumno }} {{ $prestamo->apellido2_alumno }}
                                                                                        </td>
                                                                                        <td class="py-2 px-4 border-b">
                                                                                            {{ $prestamo->curso->curso . " "}}{{$prestamo->curso->grupo}}</td>
                                                                                        <td class="py-2 px-4 border-b">
                                                                                            @php
                                                                                                $fecha = new DateTime($prestamo->fecha);
                                                                                                $fechaFormateada = $fecha->format('d/m/Y');
                                                                                            @endphp
                                                                                            {{ $fechaFormateada }}
                                                                                        </td>
                                                                                        <td class="py-2 px-4 border-b">
                                                                                            <!-- Botón para eliminar préstamo -->
                                                                                            <button onclick="borrarPrestamo({{ $prestamo->id }})"
                                                                                                class="bg-red-600 text-white px-4 py-2 rounded">
                                                                                                Cancelar
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                    @endisset



                    <!-- Mensajes de error o éxito -->
                    @if (session('error'))
                        <div class="mt-4 text-red-500">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="borrado" class="mt-4"></div>

    <!-- Llamar al js para borrar -->
    <script src="{{asset('js/borrarPrestamo.js')}}"></script>

</x-app-layout>