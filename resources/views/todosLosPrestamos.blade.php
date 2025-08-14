<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <b>Todos los prestamos</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!--Tabla de todos los prestamos-->
                    <div class="mt-8">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Lista completa de prestamos</h3>
                        <div class="overflow-x-auto">
                            <table
                                class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-gray-700">
                                        <th class="py-2 px-4 border-b">Libro</th>
                                        <th class="py-2 px-4 border-b">Alumno</th>
                                        <th class="py-2 px-4 border-b">Curso</th>
                                        <th class="py-2 px-4 border-b">Fecha prestamo</th>
                                        <th class="py-2 px-4 border-b">Cancelar prestamo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr class="border-t" id="file{{$prestamo->id}}">
                                            <td class="py-2 px-4 border-b">{{ $prestamo->libro->titulo }}</td>
                                            <td class="py-2 px-4 border-b">{{ $prestamo->nombre_alumno }}
                                                {{ $prestamo->apellido1_alumno }} {{ $prestamo->apellido2_alumno }}</td>
                                            <td class="py-2 px-4 border-b">
                                                {{ $prestamo->curso->curso . ' ' }}{{ $prestamo->curso->grupo }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @php
                                                    $fecha = new DateTime($prestamo->fecha);
                                                    $fechaFormateada = $fecha->format('d/m/Y');
                                                @endphp
                                                {{ $fechaFormateada }}
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <!-- Botón para eliminar préstamo -->
                                                <button onclick="borrarPrestamo({{ $prestamo->id }})" class="bg-red-600 text-white px-4 py-2 rounded">
                                                    Cancelar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="borrado" class="mt-4"></div>

    <!-- Llamar al js para borrar -->
    <script src="{{asset('js/borrarPrestamo.js')}}"></script>
    
</x-app-layout>
