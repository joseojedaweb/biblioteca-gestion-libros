<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Biblioteca</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <!-- Imagen de fondo que cubre toda la pantalla -->
            <img id="background" class="absolute top-0 left-0 w-full h-full object-cover z-0" src="img/fondo.jpg" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white z-10">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                        </div>
                        @if (Route::has('login'))
                            <nav class="flex flex-col justify-center items-center space-y-4"> <!-- Alineamos los botones en una columna con espacio entre ellos -->
                                @auth
                                  
                                @else
                                   <!-- Botón Iniciar sesión -->
                                   <a
                                   href="{{ route('login') }}"
                                   class="inline-block w-full rounded-md mb-4 px-6 py-6 text-xl text-white bg-[#FF2D20] hover:bg-[#D71E1C] border-2 border-[#FF2D20] hover:border-[#D71E1C] transition duration-300 transform hover:scale-105 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-[#FF2D20] dark:hover:bg-[#D71E1C] dark:focus-visible:ring-white flex items-center justify-center"
                                   style="border: 1px solid white"
                               >
                                   Iniciar sesión
                               </a>

                               @if (Route::has('register'))
                                   <!-- Botón Registro -->
                                   <a
                                       href="{{ route('register') }}"
                                       class="inline-block w-full rounded-md px-6 py-6 text-xl text-white bg-[#FF2D20] hover:bg-[#D71E1C] border-2 border-[#FF2D20] hover:border-[#D71E1C] transition duration-300 transform hover:scale-105 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-[#FF2D20] dark:hover:bg-[#D71E1C] dark:focus-visible:ring-white flex items-center justify-center"
                                       style="border: 1px solid white"
                                       >
                                            Registro
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6">
                        
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                       
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
