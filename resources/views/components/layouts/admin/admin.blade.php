<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Barra superior, menú lateral, etc. --}}
    <header class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">Panel Administrativo</h1>
    </header>

    <div class="flex">
        {{-- Sidebar o menú lateral --}}
        <aside class="w-64 bg-gray-200 min-h-screen p-4">
            <ul>
                {{-- Agrega más links aquí --}}
            </ul>
        </aside>

        {{-- Contenido dinámico del componente Livewire --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
