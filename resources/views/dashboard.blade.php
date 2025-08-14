<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <h1><b>Gestión Biblioteca de Inglés</b></h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1><b>Elige opcion</b></h1>

                    <!-- Opciones del Dashboard -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Opción: Gestionar Libros -->
                        <a href="{{ route('mostrarLibros') }}" class="bg-blue-600 text-center py-4 px-6 rounded-lg hover:bg-blue-700" style="border: 1px solid black">
                            <h1><b>Gestionar libros</b></h1>
                        </a>

                        <!-- opcion: añadir/eliminar prestamo -->
                        <a href="{{route('formulario_IsbnPrestamo')}}" class="bg-green-600 text-center py-4 px-6 rounded-lg hover:bg-green-700" style="border: 1px solid black">
                            <b>Añadir/Eliminar préstamo</b>
                        </a>

                        <!--Ver todos los prestamos-->
                        <a href="{{route('mostrar_TodosPrestamos')}}" class="bg-purple-600 text-center py-4 px-6 rounded-lg hover:bg-purple-700" style="border: 1px solid black">
                            <b>Ver todos los préstamos</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
