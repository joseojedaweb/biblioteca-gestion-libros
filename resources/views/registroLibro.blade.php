<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <b>Registro libro</b>
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
                     <!-- Mensaje de error -->
                     @if (session('error'))
                     <div class="bg-red-500 text-white p-3 rounded mb-4">
                         {{ session('error') }}
                     </div>
                    @endif

                    <!-- Parte 1: Formulario para añadir un libro -->
                    <div class="mb-6">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">Registro libro</h3>
                        <form action="{{ route('guardarLibro') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBM:</label>
                                    <input type="text" name="isbn" id="isbn" value="{{$isbn}}" class="mt-1 block w-full" required>
                                </div>
                                <div>
                                    <label for="titulo" class="block text-sm font-medium text-gray-700">Titulo:</label>
                                    <input type="text" name="titulo" id="titulo" value="{{$titulo}}" class="mt-1 block w-full" required>
                                </div>
                                <div>
                                    <label for="autor" class="block text-sm font-medium text-gray-700">Autor:</label>
                                    <input type="text" name="autor" id="autor" value="{{$autor}}" class="mt-1 block w-full" required>
                                </div>
                                <div>
                                    <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel:</label>
                                    <select name="nivel" id="nivel" class="mt-1 block w-full" required>
                                        <option value="" disabled selected>Seleccione un curso</option>
                                        <option value="1 ESO">1 ESO</option>
                                        <option value="2 ESO">2 ESO</option>
                                        <option value="3 ESO">3 ESO</option>
                                        <option value="4 ESO">4 ESO</option>
                                        <option value="1 BACHILLER">1 BACHILLER</option>
                                        <option value="2 BACHILLER">2 BACHILLER</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="ejemplares" class="block text-sm font-medium text-gray-700">Nº ejemplares:</label>
                                    <input type="text" name="ejemplares" id="ejemplares" class="mt-1 block w-full" required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <input type="submit" value="Aceptar" class="bg-blue-600 text-dark px-6 py-2 rounded">
                                <a href="{{ route('dashboard') }}" class="bg-gray-600 text-dark px-6 py-2 rounded">Cancelar</a>
                            </div>
                        </form>
                    </div><br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
