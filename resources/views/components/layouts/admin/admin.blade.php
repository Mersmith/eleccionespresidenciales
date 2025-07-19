<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - {{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> {{-- Para tu CSS personalizado si no lo gestiona Vite --}}

    @livewireStyles
</head>
<body class="admin-body" x-data="{ sidebarOpen: false }"> {{-- ¡Aquí está la clave! --}}

    <header class="admin-header">
        <h1 class="admin-logo">Panel Administrativo</h1>
        <button class="menu-toggle" @click="sidebarOpen = !sidebarOpen">☰</button>
    </header>

    <div class="admin-layout" @resize.window="sidebarOpen = (window.innerWidth >= 768)">
        <aside id="sidebar" class="admin-sidebar" :class="{ 'show': sidebarOpen }">
            <nav>
                <ul>
                    <li><a href="{{ route('admin.categoria') }}" class="{{ request()->routeIs('admin.categoria') ? 'active' : '' }}">Categorías</a></li>
                    <li><a href="{{ route('admin.encuesta.lista') }}" class="{{ request()->routeIs('admin.encuesta.lista') ? 'active' : '' }}">Encuestas</a></li>
                    <li><a href="{{ route('admin.candidato.lista') }}" class="{{ request()->routeIs('admin.candidato.lista') ? 'active' : '' }}">Candidatos</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main-content">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>