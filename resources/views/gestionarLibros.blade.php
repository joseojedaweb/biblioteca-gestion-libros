<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <b>Gestionar libros</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Mensaje de éxito -->
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif


                    <!-- Parte 1: Formulario para añadir un libro -->
                    <div class="mb-6">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Registrar libro en
                            biblioteca</h3>
                        <form action="{{ route('getLibro') }}" method="GET">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN:</label>
                                    <input type="text" name="isbn" id="isbn" class="mt-1 block w-full"
                                        required>
                                    <!-- Mostrar mensaje de error si el isbn no existe -->
                                    @if (session('error'))
                                        <div class="text-red-500 mt-2">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4">
                                <input type="submit" value="Aceptar" class="bg-blue-600 text-dark px-6 py-2 rounded">
                            </div>
                        </form>
                    </div><br>

                    <!-- Parte 2: Tabla de libros que hemos registrado ya -->
                    <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Libros registrados</h3>
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">IBSM</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Titulo</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Autor</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Unidades</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Nivel</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                                <tr id="file{{$libro->id}}">
                                    <td class="py-2 px-4">{{ $libro->isbn }}</td>
                                    <td class="py-2 px-4">{{ $libro->titulo }}</td>
                                    <td class="py-2 px-4">{{ $libro->autor ?? 'Sin descripción' }}</td>
                                    <td class="py-2 px-4">{{ $libro->num_ejemplares }}</td>
                                    <td class="py-2 px-4">{{ $libro->nivel }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <!-- Botón para eliminar préstamo -->
                                        <button onclick="eliminarLibro({{ $libro->id }})"
                                            class="bg-red-600 text-white px-4 py-2 rounded">
                                            Eliminar
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
    <div id="borrado" class="mt-4"></div>

    <!-- Llamar al js para borrar -->
    <script src="{{asset('js/eliminarLibro.js')}}"></script>
</x-app-layout>
